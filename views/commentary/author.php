<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var \models\AuthorI18n $author
 */

use widgets\AuthorInfo;

$this->setTitle($author->getName());
?>


    <div class="calendar_inside box2">
        <?= AuthorInfo::widget(['author' => $author->getAuthor()]) ?>
    </div>

        <p><?= $this->render('markup', ['txt' => $author->getDescription()]); ?></p>
        <br/><br/>
 

   

 
