<?php

namespace App\Http\Controllers\Admin;

use App\Common\JoUni;
use App\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 修改密码
    public function pswd(Request $request){
        $id = $request->session()->get('admin')->id;
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        $user = User::where('id',$id)->first();
        $jouni = new JoUni();
        if (md5($arr->oldPassword) !== $user->user_pwd){
            $jouni->status = 1;
            $jouni->message = "原密码不正确";
            return $jouni->toJson();
        }else{
            if ($arr->newPassword !== $arr->relPassword){
                $jouni->status = 1;
                $jouni->message = "两次密码不一致";
                return $jouni->toJson();
            }else{
                $user->user_pwd = md5($arr->newPassword);
                $rel = $user->save();
                if ($rel){
                    $request->session()->put('admin','');
                    $jouni->status = 0;
                    $jouni->message = "修改成功，请重新登录！";
                    return $jouni->toJson();
                }else{
                    $jouni->status = 1;
                    $jouni->message = "修改失败";
                    return $jouni->toJson();
                }
            }
        }
    }

}
