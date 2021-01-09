<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;

class AdminController extends Controller
{   
    public $category;
    function __construct(){
        $this->category = $this->categoryList();
        View::share(['departments' => DB::table('departments')->get(), 'categories' => $this->createNested($this->category)]);
    }
    public function fileUpload($request, $formvalue, $destination, $fileName){
        if ($request->hasFile($formvalue)) {
            $file = $request->file($formvalue);
            $path = $file->path();
            $extension = $file->extension();
            $fileName = $fileName . '.' . $extension;
            $patch = $file->storeAs('public/'.$destination, $fileName);
            return 'storage/'.$destination.'/'.$fileName;
        }
    }
    function adminDashboard(){
        return view('admin.dashboard.index');
    }
    function cmsIndex(){
        $qr = DB::table('cms')->paginate(20);
        $qr->Place = $this->decodePlaceQuery($qr);
        return view('admin.Cms.index')->with('cmss', $qr);
    }
    function cmsCreate(){
        return view('admin.Cms.create');
    }
    function cmsGetSingle($id){
        $qr = DB::table('cms')->where('CmsID', $id)->first();
        $qr->Place = json_decode($qr->Place);
        return $qr;
    }
    function cmsStore(Request $request){
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
                "PostTime" => date('Y-m-d H:i:s')
            ];
        $insertedRow = DB::table('cms')->insertGetId($values);
        if($insertedRow != null && $insertedRow != 0){
            $this->solveTags($values['Tags'], $insertedRow);
        }
    }
    function cmsEdit(Request $request, $id){
        $cms = $this->cmsGetSingle($id);
        return view("admin.Cms.update")->with('cms', $cms);
    }
    function cmsUpdate(Request $request, $id){
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
                "UpdateTime" => date('Y-m-d H:i:s')
            ];
            if($request->File('Avatar') != null){
                $values["Avatar"] = $this->fileUpload($request, 'Avatar', 'PostImage', date('m-d-Y_hia'));
            }
            // dd($values);
            var_dump(DB::table('cms')->where('CmsID', $id)->update($values));
    }
    function cmsDelete(Request $request, $id){
        $response = DB::table('cms')->where('CmsID', $id)->delete();
        var_dump($response);
    }
    /*
        TAG ZONE
        https://github.com/PhuongNamCorpsIntern/workspace/issues/15
    */
    function solveTags($tags, $CmsID) {
        $tagsArray = explode(',', $tags);
        foreach ($tagsArray as $tag) {
            $tags_id = DB::table('tags')->select('TagID')->where('Name', $tag)->first();
            if($tags_id != null){
                $qr = DB::table('cms_tags')->insert(['CmsID' => $CmsID, 'TagID' => $tags_id]);
            } else {
                $tags_id = DB::table('tags')->insertGetId(['Name' => $tag]);
                $qr = DB::table('cms_tags')->insert(['CmsID' => $CmsID, 'TagID' => $tags_id]);
            }
        }
        return true;
    }



    function cmsJson(){
        $db = DB::table('cms')->select('Place')->where('CmsID', 1123)->first();
        dd($db->Place);
    }
    function encodePlace($placeIn){
        $placeOut = array();
        foreach($placeIn as $place){
            array_push($placeOut, $place);
        }
        return json_encode($placeOut);
    }
    function decodePlace($jsonIn){
        $placeIn = json_decode($jsonIn);
        return $placeIn;
    }
    function decodePlaceQuery($qrs){
        foreach($qrs as $key => $qr){
            $qr->Place = json_decode($qr->Place);
        }
        return $qrs;
    }
    // 
    function cmsCategoryIndex(){
        return view('admin.CmsCategory.index')->with('categories', $this->createNested($this->category))->with('simpleCategories', DB::table('cms_categories')->paginate(20));
    }
    function cmsCategoryCreate(){
        return view('admin.CmsCategory.create');
    }
    function categoryList(){
        return DB::table('cms_categories')->get();
    }
    function createNested($categories, $ParentID = 0)
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
    function cmsCategoryStore(Request $request){
        $values = [
            'Name_vi' => $request->Name_vi,
            'Name_en' => $request->Name_en,
            'Slug_vi' => $request->Slug_vi,
            'Slug_en' => $request->Slug_en,
            'ParentID' => $request->CategoryID,
        ];
        $response = DB::table('cms_categories')->insert($values);
    }
    function cmsCategoryDelete(Request $request, $id){
        $response = DB::table('cms_categories')->where('CategoryID', $id)->delete();
    }
    function cmsCategoryEdit(Request $request, $id){
        $category = DB::table('cms_categories')->where('CategoryID', $id)->first();
        return view('admin.CmsCategory.update')->with('singleCategory', $category);
    }
    function cmsCategoryUpdate(Request $request, $id){
        $values = [
            'Name_vi' => $request->Name_vi,
            'Name_en' => $request->Name_en,
            'Slug_vi' => $request->Slug_vi,
            'Slug_en' => $request->Slug_en,
            'ParentID' => $request->CategoryID,
        ];
    }
    function userIndex(){
        $users = DB::table('admin')->join('departments', 'admin.DepartmentID', '=',  'departments.DepartmentID')->paginate(20);
        return view('admin.account.index')->with('users', $users);
    }
}