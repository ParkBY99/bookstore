<?php

namespace App\Http\Controllers\Admin;

use App\Common\JoUni;
use App\Entity\BookCategory;
use App\Entity\BookCategoryClasses;
use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Lib\upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // 分类详情视图
    public function toCategory(Request $request){
        $category = new BookCategory();
//        $categories = $category->orderBy('name','desc')->get();
        //按中文排序
        $categories = $category->orderByRaw('convert(name using gbk)')->get();
        $class = new BookCategoryClasses();
        $keyword = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];
        if ($keyword){
            $class = BookCategoryClasses::where('name', 'like', '%' . $keyword['name'] . '%')->Where('description', 'like', '%' . $keyword['description'] . '%');
        }
        $classes = $class->orderByRaw('convert(name using gbk)')->get();
        return view('admin/category/category',[
            'categories' => $categories,
            'classes' => $classes,
        ]);
    }

    // 分类/类别添加视图
    public function toCategoryAdd(){
        $category = new BookCategory();
        $categories = $category->orderBy('id','asc')->get();
        return view('admin/category/category_add',[
            'categories' => $categories,
        ]);
    }

    // 类别编辑视图
    public function toClassesEdit(Request $request,Int $id){
        $class = BookCategoryClasses::where('id',$id)->frist();
        $categories = BookCategory::orderBy('id','asc')->get();
        return view('admin/category/category_edit',[
            'categories' => $categories,
            'class' => $class,
        ]);
    }

    // 分类图片上传
    public function categoryImg(Request $request){
        if ($request->hasFile('file')){
            $upload = new upload();
            $fileArray = $upload->uploadOne('file');
            // 上传失败
            if ($fileArray['code'] != 200){
                return ["code" => 500, "message" => "图片上传失败", 'data' => []];
            }
            // 上传成功
            $data = $fileArray['data'];
            return ["code" => 200, "message" => "图片上传成功", 'data' => [
                'src' => $data['filePath'],
                'value' => $data['fileName'],
            ]];

        }else{
            //上传文件不存在
            return ["code" => 500, "message" => "图片上传失败", 'data' => []];
        }
    }

    // 分类添加
    public function categoryAdd(Request $request){
        $admin = $request->session()->get('admin','');
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        $category = [
          'name' => $arr->name,
          'description' => $arr->description,
          'image' => $arr->image,
          'update_time' => date('Y-m-d H:i:s', time()),
          'update_user_id' => $admin->id,
        ];
//        $category = new BookCategory;
//        $category->name = $name;
//        $category->description = $description;
//        $category->image = $image;
//        $category->update_time = date('Y-m-d H:i:s', time());
//        $category->update_user_id = $admin->id;
//        $res = $category->save();
        $res = DB::table('book_category')->insert($category);
//        dd($res);
        $jouni = new JoUni();
        if ($res){
            $jouni->status = 0;
            $jouni->message = '添加成功';
        }else{
            $jouni->status = 1;
            $jouni->message = '添加失败';
        }
        return $jouni->toJson();
    }

    // 分类删除
    public function categoryDel(Request $request){
        $categoryId = $request->input('id','');
        $class = BookCategoryClasses::where('category_id',$categoryId)->first();
        $jouni = new JoUni();
        if ($class){
            $jouni->status = 1;
            $jouni->message = '该分类下仍有类别，暂时无法删除！';
        }else{
            $del = DB::table('book_category')->where('id', $categoryId)->delete($categoryId);
            if ($del) {
                $jouni->status = 0;
                $jouni->message = '删除成功';
            }else{
                $jouni->status = 1;
                $jouni->message = '发生错误，删除失败';
            }
        }
        return $jouni->toJson();
    }

    // 类别添加
    public function classesAdd(Request $request){
        $admin = $request->session()->get('admin','');
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        $classes = [
            'name' => $arr->name,
            'description' => $arr->description,
            'classes_img' => $arr->image,
            'category_id' => $arr->categoryId,
            'update_time' => date('Y-m-d H:i:s', time()),
            'update_user_id' => $admin->id,
        ];
        $res = DB::table('book_category_classes')->insert($classes);
        $jouni = new JoUni();
        if ($res){
            $jouni->status = 0;
            $jouni->message = '添加成功';
        }else{
            $jouni->status = 1;
            $jouni->message = '添加失败';
        }
        return $jouni->toJson();
    }

    // 类别删除
    public function classesDel(Request $request){
        $classesId = $request->input('id','');
        $del = DB::table('book_category_classes')->where('id', $classesId)->delete($classesId);
        $jouni = new JoUni();
        if ($del) {
            $jouni->status = 0;
            $jouni->message = '删除成功';
        }else{
            $jouni->status = 1;
            $jouni->message = '发生错误，删除失败';
        }
        return $jouni->toJson();
    }

    // 类别编辑
    public function classesEdit(Request $request){
        $admin = $request->session()->get('admin','');
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        $classes = [
            'id' => $arr->id,
            'name' => $arr->name,
            'description' => $arr->description,
            'classes_img' => $arr->image,
            'category_id' => $arr->categoryId,
            'update_time' => date('Y-m-d H:i:s', time()),
            'update_user_id' => $admin->id,
        ];
        $res = DB::table('book_category_classes')->where('id',$arr->id)->update($classes);
        $jouni = new JoUni();
        if ($res){
            $jouni->status = 0;
            $jouni->message = '修改成功';
        }else{
            $jouni->status = 1;
            $jouni->message = '修改失败';
        }
        return $jouni->toJson();
    }

}
