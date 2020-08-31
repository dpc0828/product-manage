<?php


namespace app\utils;
use yii\web\UploadedFile;

class UploadImageUtils
{

    public static $base_dir = 'upload';

    public static $allow_image_extension = [
        'png',
        'jpg',
        'jpeg',
        'gif',
        'bmp'
    ];

    /**
     * 文件名
     * @return string
     */
    public static function newFileName() {
        return date('YmdHis') . mt_rand(100000000, 999999999);
    }


    /**
     * 图片上传
     * @param $name
     * @param $path
     * @return string
     * @throws \Exception
     */
    public static function uploadImage($name, $path) {
        $file = UploadedFile::getInstanceByName($name);
        if($file == null) {
            throw new \Exception('未上传图片');
        }
        $extension = $file->getExtension();
        if(!in_array($extension, self::$allow_image_extension)) {
            throw new \Exception('不支持该图片格式');
        }

        $base_dir = dirname(__DIR__) . '/web';
        if(!is_dir($base_dir . '/' . self::$base_dir . '/' . $path)) {
            @mkdir($base_dir . '/' . self::$base_dir . '/' . $path);
        }

        if(!is_dir($base_dir . '/' . self::$base_dir . '/' . $path . '/' . date('Ymd'))) {
            @mkdir($base_dir . '/' . self::$base_dir . '/' . $path . '/' . date('Ymd'));
        }
        $file_name = self::newFileName() . '.' . $extension;
        $file->saveAs($base_dir . '/' . self::$base_dir . '/' . $path . '/' . date('Ymd') . '/' . $file_name);
        return '/' . self::$base_dir . '/' . $path . '/' . date('Ymd') . '/' . $file_name;
    }
}