<?php
namespace widgets;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;


class ChaptersList extends Widget
{
    protected $book;

    public function run()
    {
 
            $news =  BibleQuery::create()
            ->withColumn('MAX(Bible.Chapter)')
            ->filterByBook_Number(1)
            ->orderByChapter()
            ->find();

            echo $book;

            return $this->json($news);
           
        }
   


    
}