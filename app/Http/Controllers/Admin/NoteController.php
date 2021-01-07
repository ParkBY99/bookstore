<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // 订单报表视图
    public function toNote(Request $request){
        return view('admin.note.note');
    }
}
