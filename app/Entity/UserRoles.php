<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';
    protected $primaryKey = 'user_role_id';
    public $timestamps = false;
}
