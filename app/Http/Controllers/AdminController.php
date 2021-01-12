<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public $category;
    public function __construct()
    {
        $this->category = $this->categoryList();
        View::share(['departments' => DB::table('departments')->get(), 'categories' => $this->createNested($this->category)]);
    }
    // Message
    public function returnMessage($code)
    {
        if ($code) {
            session(['code' => 1, 'msg' => 'Thành công!']);
            return redirect()->back();
        } else {
            session(['code' => 0, 'msg' => 'Thao tác thất bại. Vui lòng kiểm tra lại']);
            return redirect()->back();
        }
    }
    public function fileUpload($request, $formvalue, $destination, $fileName)
    {
        if ($request->hasFile($formvalue)) {
            $file = $request->file($formvalue);
            $path = $file->path();
            $extension = $file->extension();
            $fileName = $fileName . '.' . $extension;
            $patch = $file->storeAs('public/' . $destination, $fileName);
            return 'storage/' . $destination . '/' . $fileName;
        }
    }
    public function adminDashboard()
    {   
        $totalPost = DB::table('cms')->count('CmsID');
        $monthPost = DB::table('cms')->whereRaw('Month(PostTime) = ' . date('m'))->count('CmsID');
        $yourPost = DB::table('cms')->where('Author', session('admin_info')['id'])->count('CmsID');
        return view('admin.dashboard.index')->with('totalPost', $totalPost)->with('monthPost', $monthPost)->with('yourPost', $yourPost);
    }
    public function cmsIndex()
    {
        $qr = DB::table('cms')->join('admin', 'cms.Author', '=', 'admin.UserID')->orderBy('PostTime', 'DESC')->paginate(20);
        $qr->Place = $this->decodePlaceQuery($qr);
        return view('admin.Cms.index')->with('cmss', $qr);
    }
    public function cmsCreate()
    {
        return view('admin.Cms.create');
    }
    public function cmsGetSingle($id)
    {
        $qr = DB::table('cms')->where('CmsID', $id)->first();
        $qr->Place = json_decode($qr->Place);
        return $qr;
    }
    public function cmsStore(Request $request)
    {
        $values =
            [
            "Avatar" => $this->fileUpload($request, 'Avatar', 'PostImage', date('m-d-Y_hia')),
            "Title_en" => $request->Title_en,
            "Title_vi" => $request->Title_vi,
            "SimpleContent_vi" => $request->SimpleContent_vi,
            "SimpleContent_en" => $request->SimpleContent_en,
            "Content_vi" => htmlspecialchars($request->Content_vi),
            "Content_en" => htmlspecialchars($request->Content_en),
            "MetaTitle" => $request->MetaTitle,
            "MetaKeyword" => $request->MetaKeyword,
            "MetaDescription" => $request->MetaDescription,
            "Slug_vi" => $request->Slug_vi,
            "Slug_en" => $request->Slug_en,
            "CategoryID" => $request->CategoryID,
            "Place" => $this->encodePlace($request->Place),
            "Tags" => $request->Tags,
            "PostTime" => date('Y-m-d H:i:s'),
            "Pin" => $request->Pin,
            "Banner" => $request->Banner,
        ];
        $insertedRow = DB::table('cms')->insertGetId($values);
        if ($insertedRow != null && $insertedRow != 0) {
            $this->solveTags($values['Tags'], $insertedRow);
        }
        $this->returnMessage($insertedRow);
        return redirect()->back();
    }
    public function cmsEdit(Request $request, $id)
    {
        $cms = $this->cmsGetSingle($id);
        return view("admin.Cms.update")->with('cms', $cms);
    }
    public function cmsUpdate(Request $request, $id)
    {
        $values =
            [
            "Title_en" => $request->Title_en,
            "Title_vi" => $request->Title_vi,
            "SimpleContent_vi" => $request->SimpleContent_vi,
            "SimpleContent_en" => $request->SimpleContent_en,
            "Content_vi" => htmlspecialchars($request->Content_vi),
            "Content_en" => htmlspecialchars($request->Content_en),
            "MetaTitle" => $request->MetaTitle,
            "MetaKeyword" => $request->MetaKeyword,
            "MetaDescription" => $request->MetaDescription,
            "Slug_vi" => $request->Slug_vi,
            "Slug_en" => $request->Slug_en,
            "CategoryID" => $request->CategoryID,
            "Place" => $this->encodePlace($request->Place),
            "Tags" => $request->Tags,
            "UpdateTime" => date('Y-m-d H:i:s'),
            "Pin" => $request->Pin,
            "Banner" => $request->Banner,
        ];
        if ($request->File('Avatar') != null) {
            $values["Avatar"] = $this->fileUpload($request, 'Avatar', 'PostImage', date('m-d-Y_hia'));
        }
        $updatedRow = DB::table('cms')->where('CmsID', $id)->update($values);

        if ($updatedRow) {

            $this->solveTags($values['Tags'], $id);
        }
        $this->returnMessage($updatedRow);
        return redirect()->back();
    }
    public function cmsDelete(Request $request, $id)
    {
        $response = DB::table('cms')->where('CmsID', $id)->delete();
        $this->returnMessage($response);
        return redirect()->back();
    }
    /*
    TAG ZONE
    https://github.com/PhuongNamCorpsIntern/workspace/issues/15
     */
    public function solveTags($tags, $CmsID)
    {
        $tagsArray = explode(',', $tags);
        foreach ($tagsArray as $tag) {
            $tags_id = DB::table('tags')->select('TagID')->where('Name', $tag)->first();
            if ($tags_id != null) {
                $qr = DB::table('cms_tags')->insert(['TagID' => $tags_id->TagID, 'CmsID' => $CmsID]);     
            } else {
                $tags_id = DB::table('tags')->insertGetId(['Name' => $tag]);
                $qr = DB::table('cms_tags')->insert(['CmsID' => $CmsID, 'TagID' => $tags_id]);
            }
        }
        return true;
    }

    public function cmsJson()
    {
        $db = DB::table('cms')->select('Place')->where('CmsID', 1123)->first();
        dd($db->Place);
    }
    public function encodePlace($placeIn)
    {
        $placeOut = array();
        foreach ($placeIn as $place) {
            array_push($placeOut, $place);
        }
        return json_encode($placeOut);
    }
    public function decodePlace($jsonIn)
    {
        $placeIn = json_decode($jsonIn);
        return $placeIn;
    }
    public function decodePlaceQuery($qrs)
    {
        foreach ($qrs as $key => $qr) {
            $qr->Place = json_decode($qr->Place);
        }
        return $qrs;
    }
    //
    public function cmsCategoryIndex()
    {
        return view('admin.CmsCategory.index')->with('categories', $this->createNested($this->category))->with('simpleCategories', DB::table('cms_categories')->paginate(20));
    }
    public function cmsCategoryCreate()
    {
        return view('admin.CmsCategory.create');
    }
    public function categoryList()
    {
        return DB::table('cms_categories')->get();
    }
    public function createNested($categories, $ParentID = 0)
    {
        $results = [];
        foreach ($categories as $category) {
            if ($ParentID == $category->ParentID) {
                $nextParentID = $category->CategoryID;
                $category->child = $this->createNested($categories, $nextParentID);
                $results[] = $category;
            }
        }
        return $results;
    }
    public function cmsCategoryStore(Request $request)
    {
        $values = [
            'Name_vi' => $request->Name_vi,
            'Name_en' => $request->Name_en,
            'Slug_vi' => $request->Slug_vi,
            'Slug_en' => $request->Slug_en,
            'ParentID' => $request->CategoryID,
        ];
        $response = DB::table('cms_categories')->insert($values);
        $this->returnMessage($response);
        return redirect()->back();
    }
    public function cmsCategoryDelete(Request $request, $id)
    {
        $response = DB::table('cms_categories')->where('CategoryID', $id)->delete();
        $this->returnMessage($response);
        return redirect()->back();
    }
    public function cmsCategoryEdit(Request $request, $id)
    {
        $category = DB::table('cms_categories')->where('CategoryID', $id)->first();
        return view('admin.CmsCategory.update')->with('singleCategory', $category);
    }
    public function cmsCategoryUpdate(Request $request, $id)
    {
        $values = [
            'Name_vi' => $request->Name_vi,
            'Name_en' => $request->Name_en,
            'Slug_vi' => $request->Slug_vi,
            'Slug_en' => $request->Slug_en,
            'ParentID' => $request->CategoryID,
        ];
        $response = DB::table('cms_categories')->where('CategoryID', $id)->update($values);
        $this->returnMessage($response);
        return redirect()->back();
    }
    public function userIndex()
    {
        $users = DB::table('admin')->join('departments', 'admin.DepartmentID', '=', 'departments.DepartmentID')->paginate(20);
        return view('admin.account.index')->with('users', $users);
    }
    public function userStore(Request $request)
    {
        $values = [
            'Username' => $request->Username,
            'Password' => md5('admin@123'),
            'DepartmentID' => $request->DepartmentID,
            'RegisterTime' => date('Y-m-d H:i:s'),
        ];
        $response = DB::table('admin')->insert($values);
        $this->returnMessage($response);
        return redirect()->back();
    }
    public function userEdit(Request $request, $id)
    {;
        $user = DB::table('admin')->where('UserID', $id)->first();
        return view('admin.account.edit')->with('user', $user);
    }
    public function userUpdate(Request $request, $id)
    {
        $values = [
            'DepartmentID' => $request->DepartmentID,
        ];
        $response = DB::table('admin')->where('UserID', $id)->update($values);
        $this->returnMessage($response);
        return redirect()->back();
    }
    public function userReset(Request $request, $id)
    {
        $values = [
            'Password' => md5('admin@123'),
        ];
        $response = DB::table('admin')->where('UserID', $id)->update($values);
        $this->returnMessage($response);
        return redirect()->back();
    }
    public function userDelete(Request $request, $id)
    {
        $response = DB::table('admin')->where('UserID', $id)->delete();
        $this->returnMessage($response);
        return redirect()->back();
    }

    public function emailPage()
    {
        return view('admin.Cms.mailing');
    }

    public function postEmail(Request $res)
    {

        if ($res->emailtitle == null || $res->emailcontent == null) {

            return view('admin.Cms.mailing')->with('errorNotify', "Bạn chưa nhập đủ nội dung!!!");

        } else {

            $mailingList = DB::table('mailinglist')->get();
            foreach ($mailingList as $item) {
                Mail::send([], [], function ($message) use ($item, $res) {
                    $message->to($item->email);
                    $message->subject($res->emailtitle);
                    $message->setBody($res->emailcontent, 'text/html');
                });
            }

            return view('admin.Cms.mailing')->with('successNotify', "Đã gửi thành công!!!");
        }

    }

    public function getEmailList()
    {
        $mailList = DB::table('mailinglist')->get();

        return view('admin.Cms.mailinglist', compact('mailList'));
    }

}
