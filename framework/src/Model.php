<?php
namespace Framework\src;
use Framework\src\Database;
abstract class Model
{
    public $db;
    public function __construct()
    {
        $this->db = new Database('localhost', "root", 'root', 'blog');
    }
    public function get()
    {
        return $this->db->getData($this->table);
    }
    public function create($data)
    {
        $keys = [];
        $values = [];
        foreach ($data as $key => $val) {
            $keys[] = "`{$key}`";
            $values[] = "'$val'";
        }
        $keys = implode(',', $keys);
        $values = implode(',', $values);
        $this->db->setUser($keys, $values, $this->table);
    }

    public function delate($data)
    {
        $strGetaFew = "";
        foreach($data as $essenceName => $essenceData) {
            $strGetaFew .="`$essenceName`";
            foreach($essenceData as $essenceKey => $essenceItem) {
                if($essenceKey == 'operator' || $essenceKey == 'conditions' || is_int($essenceItem)) {
                    $strGetaFew  .= " $essenceItem ";
                }
                else {
                    $strGetaFew  .= " '$essenceItem' ";
                }
            }
        }
        $strGetaFew = trim(preg_replace('/[^\S\r\n]+/', ' ', $strGetaFew));
        $strGetaFew = str_replace('-double', '',  $strGetaFew);
        return $this->db->delate($this->table, $strGetaFew);
    }

    public function getTable($table)
    {
        return $this->db->getTable($table);
    }
    public function setTable($table)
    {

        if (!$this->getTable($table)) {
            throw new Exception("Нет такой тб");
        }

        $this->table = $table;
    }

    public function getUnique($data, $fields = null) {
        $keys = [];
        $values = [];
        foreach ($data as $key => $val) {
            $keys[] = "`{$key}`";
            $values[] = "'$val'";
        }
        $keys = implode(',', $keys);
        $values = implode(',', $values);
        return $this->db->getUnique($this->table, $keys, $values, $fields);

    }
    public function getaFew($data)
    {
        $strGetaFew = "";
        foreach($data as $essenceName => $essenceData) {
            $strGetaFew .="`$essenceName`";
            foreach($essenceData as $essenceKey => $essenceItem) {
                if($essenceKey == 'operator' || $essenceKey == 'conditions' || is_int($essenceItem)) {
                    $strGetaFew  .= " $essenceItem ";
                }
                else {
                    $strGetaFew  .= " '$essenceItem' ";
                }
            }
        }
        $strGetaFew = trim(preg_replace('/[^\S\r\n]+/', ' ', $strGetaFew));
        $strGetaFew = str_replace('-double', '',  $strGetaFew);
        return $this->db->getaFew($this->table, $strGetaFew);

      
      
        
    }
    public function getDefinitionData($argument) {
        return $this->db->getDefinitionData($this->table, $argument);
    }
    // public function file($file, SaveFile $type)
    // {
    //     $type->saveImage($file);
    // }
}
