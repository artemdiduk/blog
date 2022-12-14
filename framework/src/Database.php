<?php

namespace Framework\src;
use Framework\Database\Connection;
class Database
{
    public $connection;
    private $update;
    private $where;
    private $essenceName;
    private $essenceValue;
    public function __construct()
    {
       
        $this->connection = Connection::setInstances()->connectDb();
       
        if (!$this->connection) {
            throw new Exception("Нет подключение к бд");
        }
    }
    public function getData($table, $fields = true)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM `$table` $this->essenceValue");
        $row = [];
        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                if (!$fields) {
                    $row = $res;
                } else {
                    $row[] = $res;
                }
            }
            if($this->essenceValue) {
                $this->essenceValue = '';
            }
            return $row;
        }
        
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
    public  function delate($table)
    {
        $sql = "DELETE  FROM `$table` $this->essenceValue";
        return mysqli_query($this->connection, $sql);
      
    }
  
    public  function update($name, $value)
    {
        if($this->update) {
            $this->update .= ",`$name` = '$value'";
        }
        else {
            $this->update = "`$name` = '$value'";
        }
        return $this;
    }
    public function setWhere($name, $value) {
        if($this->where) {
            $this->where .= "AND '$value'";
        }
        else {
             $this->where = "`$name` = '$value'";
        }
        return $this;
    }
    public function getUpdate($table) {
        $sql = "UPDATE  `$table` SET $this->update WHERE $this->where";
        return mysqli_query($this->connection, $sql);
    }
    public function setCreate($name, $value) {
        if(($name && $value) && ($this->essenceName && $this->essenceValue)) {
            $this->essenceName .= ", `$name`";
            $this->essenceValue .= ", '$value'";
        }
        else if(($name && $value)) {
             $this->essenceName = "`$name`";
            $this->essenceValue = "'$value'";
        }
        return $this;
    }
    public function create($table) {
        $sql = "INSERT INTO `$table` ({$this->essenceName}) VALUES ({$this->essenceValue})";
        return mysqli_query($this->connection, $sql);
    }
    public function getaFew($essenceName, $essenceValue, $сonditions, $operators = null)
    {   
        if($this->essenceValue && $operators) {
            $this->essenceValue .= "`$essenceName` $сonditions '$essenceValue' $operators ";
        }
        else if($this->essenceValue) {
            $this->essenceValue .= "`$essenceName` $сonditions '$essenceValue'";
        }
        else if($operators) {
            $this->essenceValue = "WHERE `$essenceName` $сonditions '$essenceValue' $operators ";
        }
        $this->essenceValue = "WHERE `$essenceName`  $сonditions '$essenceValue'";
        return $this;
       
    }
    

}
