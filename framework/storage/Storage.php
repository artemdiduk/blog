<?php
namespace Framework\storage;
use Framework\posts\CreaterPost;
use Framework\posts\UpdatePost;
use Framework\storage\StorageArtiveSave;
use Framework\posts\CreteComment;
class Storage
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
       
    }

    public function saveImage($img, $name) {
        if($this->type instanceof CreaterPost || $this->type instanceof UpdatePost ) {
            $storege = new StorageArtiveSave();
            return $storege->saveImage($img, $name);
        }
        if ($this->type instanceof CreteComment) {
            $storege = new StorageCommentSave();
            return $storege->saveImage($img, $name);
        }
       

    }

   
}
