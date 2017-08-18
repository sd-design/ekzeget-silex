<?php
namespace widgets;

use models\Book;


class BooksList extends Widget
{
    protected $testament;

    public function run()
    {
        

        return $this->render('left_menu_books', [
            'books' => Book::getList($this->testament)
        ]);
    }

}