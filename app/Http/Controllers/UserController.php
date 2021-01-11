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
        $post = DB::table('cms')->join('cms_categories', 'cms.CategoryID', '=', 'cms_categories.CategoryID')->where('cms.Slug_vi', '=', $slug)->first();
        $post->Content_vi = html_entity_decode($post->Content_vi);
        $headnews = DB::table('cms')->where('Pin', 1)->where('Place', 'LIKE', $query)->paginate(20);
        $tags = DB::table('cms_tags')->join('tags', 'tags.TagID', '=', 'cms_tags.TagID')->where('CmsID', $post->CmsID)->get();        
        return view('user.post.index')->with('post', $post)->with('headnews', $headnews)->with('tags', $tags);
    }
    // Tin tức hoạt động
    function postBrowse(Request $request, $slug){
        $query="%$this->department%";
        $allNews = $this->browse($request, $slug, 0, 30);
        $headnews = $this->browse($request, $slug, 1, 30);
        $breadcrumb = DB::table('cms_categories')->where('Slug_vi', $slug)->first();
        return view('user.browse.index')->with('allNews', $allNews)->with('headnews', $headnews)->with('breadcrumb', $breadcrumb);
    }
    // Subscribe
    function subscribe(Request $request){
        $query = DB::table('mailinglist')->insert(['email' => $request->email]);
        if($query){
            return (['code' => 1, 'msg' => "Đăng kí thành công!"]);
        } else {
            return (['code' => 0, 'msg' => "Bạn đã đắng kí nhận tin tức rồi!"]);
        }
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

        $query = DB::table('cms')->join('cms_categories', 'cms.CategoryID', '=', 'cms_categories.CategoryID')->whereRaw('cms.CategoryID IN ('.$conditions.' 0)')->where('Place', 'LIKE', $query)->orderBy('PostTime', 'DESC');
        if($pin != 0){
            $query->where('Pin', $pin);
        }
        $result = $query->select('cms.Avatar', 'cms_categories.Name_vi', 'cms_categories.Slug_vi as SlugCat_vi', 'cms.Slug_vi', 'cms.Title_vi', 'cms.SimpleContent_vi', 'cms.PostTime', 'cms.CmsID')->paginate($item);
        return $result;
    }

    function tagsBrowse(Request $request, $tag){
        $posts = DB::table('tags')->join('cms_tags', 'tags.TagID', '=', 'cms_tags.TagID')->join('cms', 'cms_tags.CmsID', '=', 'cms.CmsID')->where('tags.Name', $tag)->get();
        // dd($posts);
        return view('user.browse.tags')->with('posts', $posts);
    }

    // CSE
    function indexCse(Request $request){
        $this->department = 2;
        $eduNews = $this->browse($request, 'tin-hoc-vu', 1, 10);
        $stdActivities = $this->browse($request, 'hoat-dong-sinh-vien', 1, 10);
        return view('cse.index.index')->with('eduNews', $eduNews)->with('stdActivities', $stdActivities);
    }
    function csePostBrowse(Request $request, $slug){
        $this->department = 2;
        $index = DB::table('cms_categories')->where('Slug_vi', $slug)->first();
        $headnews = $this->browse($request, $slug, 1, 10);
        $othernews = $this->browse($request, $slug, 0, 20);
        return view('cse.browse.browse')->with('headnews', $headnews)->with('othernews', $othernews)->with('index', $index);
    }
    function csePostView(Request $request, $slug){
        $this->department = 2;
        $post = DB::table('cms')->join('cms_categories', 'cms.CategoryID', '=', 'cms_categories.CategoryID')->where('cms.Slug_vi', '=', $slug)->first();
        $post->Content_vi = html_entity_decode($post->Content_vi);
        $category = DB::table('cms_categories')->where('CategoryID', '=', $post->CategoryID)->first();
        // dd($category->Slug_vi);
        $relatives = $this->browse($request, $category->Slug_vi, 0, 10);
        // dd($relatives);
        $tags = DB::table('cms_tags')->join('tags', 'tags.TagID', '=', 'cms_tags.TagID')->where('cms_tags.CmsID', $post->CmsID)->get();        
        return view('cse.post.index')->with('post', $post)->with('tags', $tags)->with('relatives', $relatives);
    }
    function cseTagsBrowse(Request $request, $tag) {
        $this->department = 2;
        $posts = DB::table('tags')->join('cms_tags', 'tags.TagID', '=', 'cms_tags.TagID')->join('cms', 'cms_tags.CmsID', '=', 'cms.CmsID')->where('Place', 'LIKE', '%2%')->where('tags.Name', $tag)->get();
        return view('cse.browse.tags')->with('posts', $posts);
    }

}
