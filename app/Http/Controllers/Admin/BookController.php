<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function toBook(){
        $book = new Book();

        $books = $book->orderBy('id','desc')->paginate(10);
        return view('admin/book/book',[
            'books' => $books,
        ]);
    }
}
