<?php

namespace Framework\storage;

use Framework\storage\StorageSaveMethod;

class StorageCommentSave
{
    public function saveImage($img, $name)
    {
        $saveImg = new StorageSaveMethod();
        $imgSave = $saveImg->saveParseImg($img, $name);
        if ($imgSave) {
            move_uploaded_file($img["tmp_name"], "C:/xampp/htdocs/blog/app/public/img/comments/" . $imgSave);
            return $imgSave;
        }
        return $imgSave;
    }
}
