<?php
namespace Framework\Database;
class Connection
{
    private static $instances;
    private $db;
    public static function setInstances () {
        if(!self::$instances) {
            self::$instances = new self ();
        }
        return self::$instances;
    }
    
    public function __set($name, $value)
    {
        
    }

    public function __clone()
    {
        
    }

    public function connectDb(){
        if(!$this->db) {
            $this->db = mysqli_connect('localhost', "root", 'root', 'blog');
        }
        return $this->db;
    }
}
