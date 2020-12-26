<?php

namespace App\Http\Controllers\Admin;

use App\Common\JoUni;
use App\Entity\UserRoles;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // 登录页面
    public function toLogin(){
        return view('admin/login');
    }
    // 登录验证
    public function onLogin(Request $request){
        $username = $request->input('username','');
        $password = $request->input('password','');

        $json_uni =new JoUni();
        if ($username == '' || $password == ''){
            $json_uni->status = 1;
            $json_uni->message = '帐号或密码不能为空！';
            return  $json_uni->toJson();
        }
        $admin_role = UserRoles::where('username',$username)->where('role','ROLE_ADMIN')->first();

        if (!$admin_role){
            $json_uni->status = 3;
            $json_uni->message = '非管理员账户，请重新输入！';
            return  $json_uni->toJson();
        }else{
            $admin = \App\Entity\User::where('user_name',$username)->where('user_pwd',md5($password))->first();

            if (!$admin){
                $json_uni->status = 2;
                $json_uni->message = '账户或密码错误！';
            }else{
                $json_uni->status = 0;
                $json_uni->message = '登录成功！';
                $request->session()->put('admin',$admin);
            }
        }
        return  $json_uni->toJson();
    }
    //退出登录
    public function toExit(Request $request){
        $user = $request->session()->put('admin', null);
//        $request->session()->flush();
        return redirect('/admin/login');

    }

}
