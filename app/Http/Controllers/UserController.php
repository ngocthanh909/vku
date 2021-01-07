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
        }
    }
    function getDepartments(){
        return DB::table('departments')->get();
    }
    
    function index(){
        return view('user.Index.index')->with('sub', $this->department);
    }
}
