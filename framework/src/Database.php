<?php

namespace Framework\src;

class Database
{
    public $connection;

    public function __construct($server, $user, $password, $dataBase)
    {
        $this->connection = mysqli_connect($server, $user, $password, $dataBase);
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
    public function getaFew($table, $strAFew)
    {
        $result =  mysqli_query($this->connection, "SELECT * FROM `$table` WHERE $strAFew ");
        $row = [];
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                $row[] = $res;
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
    // SELECT * FROM table WHERE count=5 AND id < 100
}
