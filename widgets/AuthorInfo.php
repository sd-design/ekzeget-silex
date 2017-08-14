<?php
namespace widgets;


use models\Author;

class AuthorInfo extends Widget
{
    /* @var Author $author */
    protected $author;

    public function run()
    {
        return $this->render('author_info', ['author' => $this->author]);
    }
}