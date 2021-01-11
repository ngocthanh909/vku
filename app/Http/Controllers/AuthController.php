<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{
    function login(Request $request){
        $value = [
            'Username'=> $request->Username,
            'Password'=> $request->Password,
        ];
        $response = DB::table('admin')->where('Username', '=', $request->Username)->where('Password', '=', md5($request->Password))->first();
        if($response != null) {
            session([
                'code' => 1,
                'msg' => "Đăng nhập thành công",
                'logged_in' => true,
                'role' => $response->DepartmentID,
                'admin_info' => ['id' => $response->UserID, 'name' => $response->Username],
            ]);
            return redirect(route('admin.dashboard'));
        } else {
            session(['code' => 0, 'msg' => "Đăng nhập thất bại."]);
            return redirect(route('admin.login'));
        }
        return redirect(route('admin.dashboard'));
    }

    function logout(){
        session()->flush();
        session(['code' => 1, 'msg' => "Bạn đã đăng xuất!"]);
        return redirect(route('admin.login'));
    }
}
