<?php

namespace App\Models;

use Framework\src\Model;

class CommentsModel extends Model
{
    protected $table = 'coments';
    public function getTableName() {
        return $this->table;
    }

}