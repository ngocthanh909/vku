<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{   
    public $department = 0;
    public $categories = 0;
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
        $this->categories = DB::table('cms_categories')->get();
    }
    function getDepartments(){
        return DB::table('departments')->get();
    }
    
    function index(){
        $query="%$this->department%";
        // echo $query;
        $headnews = DB::table('cms')->where('Pin', 1)->where('Place', 'LIKE', $query)->limit(5)->get();
        $othernews = DB::table('cms')->where('Place', 'LIKE', $query)->limit(5)->orderBy('PostTime', 'desc')->get();
        $carousel = DB::table('cms')->where('Event', 1)->where('Place', 'LIKE', $query)->limit(5)->get();
        $annous = DB::table('cms')->where('Place', 'LIKE', $query)->limit(10)->get();
        return view('user.Index.index')->with('sub', $this->department)->with('headnews', $headnews)->with('othernews', $othernews)->with('annous', $annous)->with('carousel', $carousel);

    }
    // Show post
    function postView(Request $request, $slug){
        $query="%$this->department%";
        $post = DB::table('cms')->where('Slug_vi', $slug)->first();
        $post->Content_vi = html_entity_decode($post->Content_vi);
        $headnews = DB::table('cms')->where('Pin', 1)->where('Place', 'LIKE', $query)->paginate(20);
        return view('user.post.index')->with('post', $post)->with('headnews', $headnews);
    }
    // Tin tức hoạt động
    function postBrowse(Request $request, $slug){
        $query="%$this->department%";
        $allNews = $this->browse($request, $slug, 0, 30);
        $headnews = $this->browse($request, $slug, 1, 30);
        return view('user.browse.index')->with('allNews', $allNews)->with('headnews', $headnews);
    }

    function crawler(){
        $listQuereFile = DB::table('cms')->where('Avatar','!=', '' )->get();
        foreach($listQuereFile as $quereFile){
            $quereFile->Avatar = ("http://vku.udn.vn/uploads/" . $quereFile->Avatar);
        };
        foreach($listQuereFile as $quereFile){
            $result = DB::table('cms')->where('CmsID', $quereFile->CmsID)->update(['Avatar' => $quereFile->Avatar]);
            echo "<br>" . $result;
        }
    }
    
    // Nested CMS
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
    // Rescusive CMS
    // function rescusiveCms($structred_categories){
    //     foreach($structred_categories as $structred_category){
    //         array_push($this->result, $structred_category->CategoryID);
    //         var_dump($this->result);
    //         if(!empty($structred_category->child)){
    //             $this->rescusiveCms($structred_category->child);
    //         }
    //     }
    // }
    public $fullList = array();
    function rescusiveCms($structred_categories, $result){
        // dd($structred_categories);
        foreach($structred_categories as $structred_category){
            array_push($result, $structred_category->CategoryID);
            array_push($this->fullList, $structred_category->CategoryID);
            if(!empty($structred_category->child)){
                $this->rescusiveCms($structred_category->child, $result);
            }
        } 
        return $result;
    }
    // New CMS System
    function browse($request, $slug, $pin, $item){
        $query="%$this->department%";
        $category = DB::table('cms_categories')->where('Slug_vi', $slug)->first();
        $structred_categories = $this->createNested($this->categories, $category->CategoryID);
        $result = [];
        $this->rescusiveCms($structred_categories, $result);
        $conditions = null;
        if(empty($structred_categories)) {
            $temp = "'".$category->CategoryID."',";
            $conditions = $conditions.$temp;
        } else {
            foreach($this->fullList as $listItem) {
                $temp = "'".$listItem."',";
                $conditions =  $conditions.$temp;
            }
        }

        $result = DB::table('cms')->whereRaw('CategoryID IN ('.$conditions.' 0)')->where('Place', 'LIKE', $query)->where('Pin', $pin)->orderBy('PostTime', 'DESC')->paginate($item);
        return $result;
    }

    function newsAndEventPosts() {
        
    }
}
