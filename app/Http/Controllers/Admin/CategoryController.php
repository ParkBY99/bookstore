<?php

namespace App\Http\Controllers\Admin;

use App\Entity\BookCategory;
use App\Entity\BookCategoryClasses;
use App\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function toCategory(Request $request){
        $category = new BookCategory();
        $categories = $category->orderBy('id','desc')->get();
        $class = new BookCategoryClasses();
        $keyword = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];
        if ($keyword){
            $class = BookCategoryClasses::where('name', 'like', '%' . $keyword['name'] . '%')->Where('description', 'like', '%' . $keyword['description'] . '%');
        }
        $classes = $class->orderBy('id','desc')->get();
        return view('admin/category/category',[
            'categories' => $categories,
            'classes' => $classes,
        ]);
    }
}
