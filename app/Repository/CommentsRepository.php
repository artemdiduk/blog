<?php

namespace App\Repository;

use App\Models\CommentsModel;

class CommentsRepository
{
    private $comments;

    public function __construct(CommentsModel $comments)
    {
        $this->comments = $comments;
    }
    
    public function getCommentsPost($post, $data) {
        return $this->comments->getaFew($post, $data);
    }
    public function createComments($comments)
    {
        $this->comments
        ->setCreate('user', $comments['user'])
        ->setCreate('text', $comments['text'])
        ->setCreate('post', $comments['post'])
        ->setCreate('img', $comments['img'])
        ->create();
    }
    public function getCommentsPostAndAuthor($post, $dataPost, $author, $dataAuthor)
    {
        return $this->comments->getAfew($post, $dataPost, "AND")->getAfew($author, $dataAuthor);
    }
    public function updateComments($comments) {
        $this->comments->update('post', $comments['post'])->setWhere('post', $comments['whats'])->getUpdate();
    }
}   

