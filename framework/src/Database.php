<?php

namespace Framework\src;
use Framework\Database\Connection;
class Database
{
    public $connection;

    public function __construct()
    {
       
        $this->connection = Connection::setInstances()->connectDb();
       
        if (!$this->connection) {
            throw new Exception("Нет подключение к бд");
        }
    }
    public function getData($table)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM `$table`");
        $row = [];
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                $row[] = $res;
            }
            return $row;
        }
    }
    public  function setUser($key, $value, $table)
    {
        $sql = "INSERT INTO `$table`({$key}) VALUES ({$value})";
        return mysqli_query($this->connection, $sql);
    }

    public function getTable($table)
    {
        return mysqli_query($this->connection, "SELECT * FROM `$table`");
    }

    public function getUnique($table, $key, $value, $fields = null)
    {
        $result =  mysqli_query($this->connection, "SELECT * FROM `$table` WHERE {$key} = {$value} ");
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                if (!$fields) {
                    $row = $res;
                }
                else {
                    $row[] = $res;
                }

            }
            return $row;
        }
    }
    public function getUniques($table, $key, $value)
    {
        $result =  mysqli_query($this->connection, "SELECT * FROM `$table` WHERE {$key} = {$value} ");
        return mysqli_fetch_all($result);
    }
    public function getaFew($table, $strAFew, $fields = true)
    {
        $result =  mysqli_query($this->connection, "SELECT * FROM `$table` WHERE $strAFew ");
        $row = [];
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                if(!$fields) {
                    $row = $res;
                }
                else {
                    $row[] = $res;
                }
                
            }
            return $row;
        }
    }
    public function getDefinitionData($table, $argument)
    {
        $result =  mysqli_query($this->connection, "SELECT  `$argument` FROM `$table`");

        $row = [];
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                $row[] = $res;
            }
            return $row;
        }
    }
    public  function delate ($table, $strAFew)
    {
        $sql = "DELETE  FROM `$table` WHERE $strAFew ";
       return mysqli_query($this->connection, $sql);
    }
    public  function update($table, $str)
    {
        $sql = "UPDATE  `$table` SET $str";
        return mysqli_query($this->connection, $sql);
        
    }
}
