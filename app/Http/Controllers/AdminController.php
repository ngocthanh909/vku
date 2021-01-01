<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{   
    public $category;
    function __construct(){
        $this->category = $this->categoryList();
    }
    function dashboard(){
        return view('admin.dashboard.index');
    }
    function cmsCreate(){
        return view('admin.Cms.create')->with('categories', $this->createNested($this->category));
    }
    function cmsStore(Request $request){
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
                "Avatar" => $request->avatar,
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
                "CategoryID" => $request->CategoryID
            ];
        var_dump(DB::table('cms')->insert($values));
    }

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