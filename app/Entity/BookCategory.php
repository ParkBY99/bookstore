<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $table = 'book_category';
    protected $primaryKey = 'id';
    public $timestamps = false;


}
