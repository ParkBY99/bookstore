<?php

namespace App\Http\Controllers\Admin;

use App\Common\JoUni;
use App\Entity\User;
use App\Entity\UserRoles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // 用户管理视图
    public function toUser(Request $request){
//        $users = User::orderBy('nickname','desc')->paginate(12);
        $keyword = [
            'nickname' => $request->input('nickname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'registerTime' => $request->input('registerTime'),
            'userRole' => $request->input('userRole'),
        ];
        $users = DB::table('user')
            ->join('user_roles', 'user.id', '=', 'user_roles.user_id')
            ->where('user.nickname', 'like', '%' . $keyword['nickname'] . '%')
            ->Where('user.user_name', 'like', '%' . $keyword['username'] . '%')
            ->Where('user.email', 'like', '%' . $keyword['email'] . '%')
            ->Where('user.register_time', 'like', '%' . $keyword['registerTime'] . '%')
            ->Where('user_roles.role',  'like', '%' . $keyword['userRole'] . '%')
            ->orderByRaw('convert(nickname using gbk)')
            ->select('user.*', 'user_roles.role')
            ->paginate(12);
//        dd($users);
        return view('admin.user.user',[
            'users' => $users,
            'keyword' => $keyword,
        ]);
    }

    // 修改密码
    public function edit(Request $request){
        $id = $request->session()->get('admin')->id;
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        $user = User::where('id',$id)->first();
        $user->user_img = $arr->activeUserimg;
        $user->nickname = $arr->activeNickname;
        $user->user_name = $arr->activeUsername;
        $user->email = $arr->activeEmail;
        $rel = $user->save();
        $jouni = new JoUni();
        if ($rel){
            $admin = User::where('id',$id)->first();
            $request->session()->put('admin',$admin);
            $jouni->status = 0;
            $jouni->message = "修改成功！";
            return $jouni->toJson();
        }else{
            $jouni->status = 1;
            $jouni->message = "修改失败！";
            return $jouni->toJson();
        }
    }

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
                    //清空session以进行重新登录
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

    // 添加新管理员
    public function add(Request $request){
        $id = $request->session()->get('admin')->id;
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        $jouni = new JoUni();
        if ($arr->password !== $arr->relUserPassword){
            $jouni->status = 1;
            $jouni->message = "两次密码不一致";
            return $jouni->toJson();
        } else {
            $relUsername = User::where('user_name',$arr->username)->first();
            if ($relUsername){
                $jouni->status = 1;
                $jouni->message = "该用户已注册，请进行登录";
                return $jouni->toJson();
            }else{
                $user = [
                    'user_name' => $arr->username,
                    'user_pwd' => md5($arr->password),
                    'nickname' => $arr->nickname,
                    'email' => $arr->email,
                    'enabled' => 1,
                    'user_img' => $arr->image,
                    'last_login_time' => date('Y-m-d H:i:s', time()),
                    'register_time' => date('Y-m-d H:i:s', time()),
                ];

                DB::beginTransaction(); //开启事务
                $resUser = DB::table('user')->insertGetId($user);
                if ($resUser) {
                    $userRole = [
                        'user_id' => $resUser,
                        'username' => $arr->username,
                        'role' => 'ROLE_ADMIN',
                    ];
                    $resRole = DB::table('user_roles')->insert($userRole);
                    if ($resRole){
                        DB::commit();
                        $jouni->status = 0;
                        $jouni->message = "添加新管理员成功";
                        return $jouni->toJson();
                    }else{
                        DB::rollBack();
                        $jouni->status = 1;
                        $jouni->message = "添加新管理员失败，请重试";
                        return $jouni->toJson();
                    }
                }else{
                    DB::rollBack();
                    $jouni->status = 1;
                    $jouni->message = "添加管理员失败，请重试";
                    return $jouni->toJson();
                }
            }
        }

    }

}
