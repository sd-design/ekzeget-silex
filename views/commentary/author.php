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


<td style="width:180px">

</td>
<td>
    <div style="width:610px;">
        <br/>

        <p><?= $this->render('markup', ['txt' => $author->getDescription()]); ?></p>
        <br/><br/>
    </div>
</td>
<td style="width:200px">
    <div class="box">
        <?= AuthorInfo::widget(['author' => $author->getAuthor()]) ?>
    </div>
    <br/>
    <div align="center">

        <a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="IMG/orphus.gif" border="0"
                                                                    width="125" height="115"/></a>
    </div>
    <br/>
</td>
</tr>