<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
//    关联方法
    public function contects(){
        return $this->hasMany('App\Entity\User','user_id','id');
    }
}
