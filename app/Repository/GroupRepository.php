<?php

namespace App\Repository;
use App\Models\GroupModel;

class GroupRepository
{
    private $group;

    public function __construct(GroupModel $group)
    {
        $this->group = $group;
    }
    public function getGroupUrl($url, $data)
    {
        return  $this->group->getaFew($url, $data);
    }
    public function getRoutsModel($argument)
    {
        return $this->group->getDefinitionData($argument);
    }
    public function getAll($fields = true) {
       return $this->group->get($fields);
    }
    public function createGroup($group) {
        $this->group->setCreate('name', $group['name'])->
        setCreate('url', $group['url'])->
        create();        
    }
}
