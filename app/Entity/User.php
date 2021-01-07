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
    public function userrole(){
        return $this->hasOne('App\Entity\UserRoles','user_id','id');
    }
}
