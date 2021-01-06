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
use Illuminate\View\View;

class BookController extends Controller
{
    // 图书详情管理视图
    public function toBook(Request $request){
//        $book = new Book();
        $categories = BookCategory::orderBy('id','asc')->get();
        $classes = BookCategoryClasses::orderBy('id','asc')->get();
        $keyword = [
            'name' => $request->input('name'),
            'author' => $request->input('author'),
            'category_id' => $request->input('category'),
            'classes_id' => $request->input('classes'),
            'hot' => $request->input('hot'),
            'book_status' => $request->input('status'),
        ];
        $classesFirst = BookCategoryClasses::where('category_id',$keyword['category_id'])->get();
        $books = Book::where('name', 'like', '%' . $keyword['name'] . '%')
            ->Where('author', 'like', '%' . $keyword['author'] . '%')
            ->Where('category_id', 'like', '%' . $keyword['category_id'] . '%')
            ->Where('classes_id', 'like', '%' . $keyword['classes_id'] . '%')
            ->Where('hot', 'like', '%' . $keyword['hot'] . '%')
            ->Where('book_status', 'like', '%' . $keyword['book_status'] . '%')
            ->orderByRaw('convert(name using gbk)')
            ->paginate(6);
        return view('admin.book.book',[
            'books' => $books,
            'categories' => $categories,
            'classes' => $classes,
            'classesFirst' => $classesFirst,
            'keyword' => $keyword,
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
    public function toBookEdit(Request $request){
        $id = $request->input('id','');
        $book = Book::where('id',$id)->first();
        $categories = BookCategory::orderBy('id','asc')->get();
        $classes = BookCategoryClasses::orderBy('id','asc')->get();
        return view('admin.book.book_edit',[
            'categories' => $categories,
            'classes' => $classes,
            'book' => $book,
        ]);
    }

    // 图书添加
    public function bookAdd(Request $request){
        $admin = $request->session()->get('admin','');
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
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
            'hot' => 2,
            'book_status' => 1,
            'update_time' => date('Y-m-d H:w:s', time()),
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

    // 图书编辑
    public function bookEdit(Request $request){
        $admin = $request->session()->get('admin','');
        $arr = $request->input('arr','');
        $arr = json_decode($arr);
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
            'inventory' => $arr->inventory,
            'hot' => $arr->hot,
            'book_status' => $arr->status,
            'update_time' => date('Y-m-d H:i:s', time()),
            'update_user_id' => $admin->id,
        ];
        $res = DB::table('book')->where('id',$arr->id)->update($book);
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

    // 图书删除
    public function bookDel(Request $request){
        $bookId = $request->input('id','');
        $del = DB::table('book')->where('id', $bookId)->delete($bookId);
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
}
