<?php
/**
 * Created by PhpStorm.
 * User: 75654
 * Date: 2020/12/16
 * Time: 13:11
 */

namespace App\Common;

//封装一个Json不要编码Unicode的响应方法，即不编码中文。
class JoUni
{
    public $status;
    public $message;

    public function toJson(){
        return json_encode($this,JSON_UNESCAPED_UNICODE);
    }
}