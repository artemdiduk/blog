<?php

namespace Framework\services;

use App\Interface\SaveFile;

class SaveImg implements SaveFile
{
    public function saveImage($img, $name, $path)
    {
        if (empty($img['name'])) {
            return '';
        }
        $nameImg = str_replace("/", "-", $name, $count);
        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
        $new_name = $nameImg . uniqid() . '.'  . $extension;
        move_uploaded_file($img["tmp_name"], "$path" . $new_name);
        return  $new_name;
    }
}