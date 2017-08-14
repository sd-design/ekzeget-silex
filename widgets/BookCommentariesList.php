<?php

namespace widgets;

use models\Book;

class BookCommentariesList extends Widget
{
    /* @var Book $book */
    protected $book;

    public function run()
    {
        return $this->render('book_commentaries_list', [
            'commentaries' => $this->book->getBookCommentaries(),
            'bookAbbr'     => $this->book->getTranslation()->getAbbreviation()
        ]);
    }
}