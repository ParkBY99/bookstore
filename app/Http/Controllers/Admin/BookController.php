<?php

namespace App\Http\Controllers\Admin;

use App\Common\JoUni;
use App\Entity\Book;
use App\Entity\BookCategory;
use App\Entity\BookCategoryClasses;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // 图书详情管理视图
    public function toBook(){
        $book = new Book();

        $books = $book->orderBy('id','desc')->paginate(10);
        return view('admin/book/book',[
            'books' => $books,
        ]);
    }

    // 图书添加视图
    public function toBookAdd(){
        $categories = BookCategory::orderBy('id','asc')->get();
        $classes = BookCategoryClasses::orderBy('id','asc')->get();
        $categoryId = BookCategory::orderBy('id','asc')->first()->id;
        $classesFirst = BookCategoryClasses::where('category_id',$categoryId)->get();
        return view('admin.book.book_add',[
            'categories' => $categories,
            'classes' => $classes,
            'classesFirst' => $classesFirst,
        ]);
    }

    // 图书编辑视图
    public function toBookEdit(){

    }

    // 图书添加
    public function bookAdd(Request $request){
        $admin = $request->session()->get('admin','');
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
        if ($arr->price)
        $book = [
            'name' => $arr->name,
            'author' => $arr->author,
            'category_id' => $arr->categoryId,
            'classes_id' => $arr->classesId,
            'description' => $arr->description,
            'book_img' => $arr->image,
            'price' => $arr->price,
            'rental_prices' => $arr->rentalPrices,
            'quantity' => $arr->quantity,
            'inventory' => $arr->quantity,
            'hot' => 0,
            'book_status' => 0,
            'update_time' => date('Y-m-d H:i:s', time()),
            'update_user_id' => $admin->id,
        ];
        $res = DB::table('book')->insert($book);
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
}
