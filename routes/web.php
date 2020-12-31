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

// /
Route::get('/', function () {
    if (session()->get('admin')) {
        return redirect('/admin/books/category');
    }else{
        return redirect('/admin/login');
    }
});

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){
    // admin/
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
            // admin/books
            // 图书分类视图
            Route::get('category','CategoryController@toCategory');
            Route::get('category_add','CategoryController@toCategoryAdd');
            Route::get('classes_edit','CategoryController@toClassesEdit');
            // 图书详情视图
            Route::get('book','BookController@toBook');
            Route::get('book_add','BookController@toBookAdd');
            Route::get('book_edit','BookController@toBookEdit');
            // 图书评论视图
            Route::get('comment','CommentController@toComment');
        });
        // admin/service
        // 服务
        Route::group(['prefix' => 'service'],function (){
            // 图片上传
            Route::post('category/img','CategoryController@categoryImg');
        // 图书分类/类别功能
            // 分类添加
            Route::post('category/add','CategoryController@categoryAdd');
            // 分类删除
            Route::post('category/del','CategoryController@categoryDel');
            // 类别添加
            Route::post('classes/add','CategoryController@classesAdd');
            // 类别删除
            Route::post('classes/del','CategoryController@classesDel');
            // 类别编辑
            Route::post('classes/edit','CategoryController@classesEdit');

        // 图书详情功能
            // 分类添加
            Route::post('book/add','BookController@bookAdd');
            // 分类删除
            Route::post('book/del','BookController@bookDel');
            // 类别编辑
            Route::post('book/edit','BookController@bookEdit');

        });

    });

});
