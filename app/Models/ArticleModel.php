<?php

namespace App\Models;
use Framework\src\Model;
class ArticleModel extends  Model
{
    protected $table = 'post';
    public function getTableName() {
        return $this->table;
    }
}


