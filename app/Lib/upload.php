<?php
/**
 * Created by PhpStorm.
 * User: 75654
 * Date: 2020/12/27
 * Time: 9:16
 */

namespace App\Lib;

use http\Params;
use Illuminate\Support\Facades\Storage;


class upload {
    //单图片上传
    public function uploadOne($uploadName)
    {
        // 调用request
        $request = app('request');
        // 获取文件
        $file = $request->file($uploadName);
        // 文件格式
        $allowExtenstions = ['jpg', 'png', 'jpeg', 'gif', 'mp3', 'mp4'];
        // 判断文件格式是否正确 getClientOriginalName获取客户端文件名称 getClientOriginalExtension获取文件后缀
        if ($file->getClientOriginalName() && !in_array($file->getClientOriginalExtension(),$allowExtenstions)){
            return ['code' => 102, "message" => '上传文件格式错误！', "data" => []];
        }
        // 按日期创建存储文件夹  // @表示忽略mkdir生程的错误信息
        $pathRoot = '/Bookstore/uploads/'.date('Y-m-d');
        if (!is_dir(public_path() . $pathRoot) && !@mkdir(public_path() . $pathRoot, 0777, true)) {
            return ["code" => 500, "message" => "目录创建失败", "data" => []];
        }
        // 获取图片后缀
        $ext = $file->getClientOriginalExtension();
        // 获取临时文件绝对路径
        $realPath = $file->getRealPath();
        //以当前日期生成文件名并md5()加密
        $fileName = md5(date('Ymd',time())) . '-' . uniqid() . '.' . $ext;
        //生成储存路径
        $filePath = $pathRoot.'/'.$fileName;
        //存储
        $bool = Storage::disk('uploads')->put($filePath,file_get_contents($realPath));

        //判断是否上传成功
        if (!$bool){
            return ["code" => 500, "message" => '图片上传失败', "data" => []];
        }
        //生成图片格式对应data;
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif') {
            $fileArray = ["code" => 200, "data" => ['filePath' => $filePath, 'fileName' => $fileName], "type" => 'image'];
        } elseif ($ext == 'mp4') {
            $fileArray = ["code" => 200, "data" => ['filePath' => $filePath, 'fileName' => $fileName], "type" => 'mp4'];
        } elseif ($ext == "mp3") {
            $fileArray = ["code" => 200, "data" => ['filePath' => $filePath, 'fileName' => $fileName], "type" => 'mp3'];
        } else {
            $fileArray = ["code" => 200, "data" => ['filePath' => $filePath, 'fileName' => $fileName], "type" => 'other'];
        }

        return $fileArray;
    }


}