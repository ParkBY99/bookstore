<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "book";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\Entity\User','id','update_user_id');
    }
    public function category(){
        return $this->hasOne('App\Entity\BookCategory','id','category_id');
    }
    public function classes(){
        return $this->hasOne('App\Entity\BookCategoryClasses','id','classes_id');
    }
}
