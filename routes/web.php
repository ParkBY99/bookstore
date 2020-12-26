<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (session()->get('admin')) {
        return redirect('/admin/index');
    }else{
        return redirect('/admin/login');
    }
});
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){
    // 登录页面视图
    Route::get('login','LoginController@toLogin');
    // 登录验证
    Route::post('on_login','LoginController@onLogin');
    // 退出登录
    Route::get('exit','LoginController@toExit');
    //添加中间件验证登录
    Route::group(['middleware' => 'admin.isLogin'],function(){
        // 首页视图
        Route::get('index','IndexController@toIndex');
        // 禁止访问首页视图（父模板）index
        Route::get('index','LoginController@toExit');
        // 图书管理
        Route::group(['prefix' => 'books'],function (){
            //图书分类视图
            Route::get('category','CategoryController@toCategory');
            Route::get('category_add','CategoryController@toCategoryAdd');
            Route::get('category_edit','CategoryController@toCategoryEdit');
            //图书详情视图
            Route::get('book','BookController@toBook');
            Route::get('book_add','BookController@toBookAdd');
            Route::get('book_edit','BookController@toBookEdit');
            //图书评论视图
            Route::get('comment','CommentController@toComment');
        });


    });

});
