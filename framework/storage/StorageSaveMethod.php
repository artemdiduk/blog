<?php

namespace Framework\storage;

class StorageSaveMethod 
{
   public function saveParseImg($img, $name) {
        if (empty($img['name'])) {
            return '';
        }
        $nameImg = str_replace("/", "-", $name, $count);
        $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
        $new_name = $nameImg . uniqid() . '.'  . $extension;
        return $new_name;
   }
}
