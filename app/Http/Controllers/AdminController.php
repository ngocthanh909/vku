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
    function dashboard(){
        return view('admin.dashboard.index');
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
        // dd($this->encodePlace($request->Place));
        // $values = $request->validate(
        //     [      
        //         "Avatar" => "required|max:255",
        //         "Title_en" => "required|max:255",
        //         "SimpleContent_vi" => "required|max:255",
        //         "SimpleContent_en" => "required|max:255",
        //         "Content_vi" => "required|max:65000",
        //         "Content_en" => "required|max:65000",
        //         "MetaTitle" => "required|max:255",
        //         "MetaKeyword" => "required|max:255",
        //         "MetaDescription" => "required|max:255",
        //         "Slug_vi" => "required|max:255",
        //         "Slug_en" => "required|max:255",
        //         "CmsCategory" => "required"
        //     ]
        // );
        $values =
            [      
                "Avatar" => $this->fileUpload($request, 'Avatar', 'PostImage', date('m-d-Y_hia')),
                "Title_en" => $request->Title_en,
                "Title_vi" => $request->SimpleContent_vi,
                "SimpleContent_vi" => $request->SimpleContent_vi,
                "SimpleContent_en" => $request->SimpleContent_en,
                "Content_vi" => $request->Content_vi,
                "Content_en" => $request->Content_en,
                "MetaTitle" => $request->MetaTitle,
                "MetaKeyword" => $request->MetaKeyword,
                "MetaDescription" => $request->MetaDescription,
                "Slug_vi" => $request->Slug_vi,
                "Slug_en" => $request->Slug_en,
                "CategoryID" => $request->CategoryID,
                "Place" => $this->encodePlace($request->Place)
            ];
        var_dump(DB::table('cms')->insert($values));
    }
    function cmsEdit(Request $request, $id){
        $cms = $this->cmsGetSingle($id);
        return view("admin.Cms.update")->with('cms', $cms);
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
    // 
    function cmsCategoryIndex(){
        return view('admin.CmsCategory.index')->with('categories', $this->createNested($this->category));
    }
    function cmsCategoryCreate(){
        return view('admin.CmsCategory.index');
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
}