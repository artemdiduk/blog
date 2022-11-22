<?php
namespace App\Models;
use Framework\src\Model;
class UserModel extends Model
{
    protected $table = 'users';
    public function getTableName() {
        return $this->table;
    }
    

}
