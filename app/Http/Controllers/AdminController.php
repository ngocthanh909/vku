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
        $values =
            [      
                "Avatar" => $this->fileUpload($request, 'Avatar', 'PostImage', date('m-d-Y_hia')),
                "Title_en" => $request->Title_en,
                "Title_vi" => $request->Title_vi,
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
                "Place" => $this->encodePlace($request->Place),
                "Tags" => $request->Tags,
            ];
        $insertedRow = DB::table('cms')->insertGetId($values);
        if($insertedRow != null && $insertedRow != 0){
            $this->solveTags($values['Tags'], $insertedRow);
        }
    }
    function cmsEdit(Request $request, $id){
        $cms = $this->cmsGetSingle($id);
        // dd($cms->Place);
        return view("admin.Cms.update")->with('cms', $cms);
    }
    function cmsUpdate(Request $request, $id){
        $values =
            [      
                "Title_en" => $request->Title_en,
                "Title_vi" => $request->Title_vi,
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
                "Place" => $this->encodePlace($request->Place),
                "Tags" => $request->Tags,
            ];
            if($request->File('Avatar') != null){
                $values["Avatar"] = $this->fileUpload($request, 'Avatar', 'PostImage', date('m-d-Y_hia'));
            }
            // dd($values);
            var_dump(DB::table('cms')->where('CmsID', $id)->update($values));
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