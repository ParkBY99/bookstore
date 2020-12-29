<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class BookCategoryClasses extends Model
{
    protected $table = 'book_category_classes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\Entity\User','id','update_user_id');
    }
    public function category(){
        return $this->hasOne('App\Entity\BookCategory','id','category_id');
    }
}
