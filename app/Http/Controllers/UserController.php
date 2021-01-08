<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{   
    public $department = 0;
    function __construct(Request $request){
        $departments = $this->getDepartments();
        foreach($departments as $department){
            if($request->sub == $department->Alias) {
                $this->department = $department->DepartmentID;
            } 
            elseif($request->sub == '') {
                $this->department = 1;
            }
        }
    }
    function getDepartments(){
        return DB::table('departments')->get();
    }
    
    function index(){
        $query="%$this->department%";
        echo $query;
        $headnews = DB::table('cms')->where('Pin', 1)->where('Place', 'LIKE', $query)->limit(5)->get();
        $othernews = DB::table('cms')->where('Place', 'LIKE', $query)->limit(5)->orderBy('PostTime', 'desc')->get();
        $annous = DB::table('cms')->join('cms_categories', 'cms.CategoryID', '=', 'cms_categories.CategoryID')->limit(10)->get();
        return view('user.Index.index')->with('sub', $this->department)->with('headnews', $headnews)->with('othernews', $othernews)->with('annous', $annous);

    }
    // Show post
    function postView(Request $request, $slug){
        $query="%$this->department%";
        $post = DB::table('cms')->where('Slug_vi', $slug)->first();
        $post->Content_vi = html_entity_decode($post->Content_vi);
        $headnews = DB::table('cms')->where('Pin', 1)->where('Place', 'LIKE', $query)->paginate(20);
        return view('user.post.index')->with('post', $post)->with('headnews', $headnews);
    }
    // Browse
    function postBrowse(Request $request){
        $query="%$this->department%";
        $allNews = DB::table('cms')->where('Place', 'LIKE', $query)->orderBy('PostTime', 'desc')->paginate(20);
        $headnews = DB::table('cms')->where('Pin', 1)->where('Place', 'LIKE', $query)->paginate(20);
        return view('user.browse.index')->with('allNews', $allNews)->with('headnews', $headnews);
    }
}
