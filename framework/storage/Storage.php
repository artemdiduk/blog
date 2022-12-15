<?php
namespace Framework\storage;
use Framework\posts\CreaterPost;
use Framework\posts\UpdatePost;
use Framework\storage\StorageArtiveSave;
use Framework\src\CreteComment;

class Storage
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
       
    }
    
    public function saveImage($img, $name) {
      
        if($this->type == CreaterPost::class || $this->type == UpdatePost::class ) {
            $storege = new StorageArtiveSave();
            return $storege->saveImage($img, $name);
        }
        if ($this->type == CreteComment::class) {
            $storege = new StorageCommentSave();
            return $storege->saveImage($img, $name);
          
        }
        

    }

   
}
