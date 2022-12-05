<?php
namespace Framework\services;
use Framework\services\SaveImg;
class Services
{
    public static function saveImage($img, $name, $path) {
        $save = new SaveImg();
        return $save->saveImage($img, $name, $path);
    }
}