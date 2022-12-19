<?php

namespace App\Repository;
use App\Models\ArticleModel;
class ArticleRepository
{
    private $post;

    public function __construct(ArticleModel $post)
    {
        $this->post = $post;
    }
    public function getPostUrl($url, $data) {
        return $this->post->getaFew($url, $data);
      
    }
    public function getPostUrlAndAuthor($url, $dataUrl, $author, $dataAuthor) {
       return $this->post->getAfew($url, $dataUrl, "AND")->getAfew($author, $dataAuthor);
    }
    public function getPostGroup($group, $data)
    {
        return $this->post->getaFew($group, $data);
    }
    public function getRoutsModel($argument)
    {
        return $this->post->getDefinitionData($argument);
    }
    public function createPost($post) {
        $this->post->setCreate('name', $post['name'])->
        setCreate('url', $post['url'])->
        setCreate('text', $post['text'])->
        setCreate('group', $post['group'])->
        setCreate('author', $post['author'])-> 
        setCreate('img', $post['img'])->
        create();        
    }
    public function updatePost($post) {
        $this->post->update("name", $post['name'])->
        update("text", $post['text'])->
        update('group', $post['group'])->
        update('url', $post['url'])->
        update('img', $post['img'])->
        setWhere('id', $post['id'])->
        getUpdate();
    }
}
