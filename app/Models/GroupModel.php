<?php

namespace App\Models;

use Framework\src\Model;

class GroupModel extends Model
{
    protected $table = 'group';
    public function getTableName() {
        return $this->table;
    }
}
