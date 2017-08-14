<?php
/**
 * @var \Application $app
 * @var \widgets\BackAndForth $this
 * @var string $assets
 * @var array $params
 * @var false|string $back
 * @var false|string $forth
 */

?>
<table cellpadding="0" cellspacing="0" align=center border=0>
    <tr align=center>
        <td width=50 style="vertical-align: bottom;">
            <?php if ($back):?>
                <span class="ssil_uvelich_gl">
        <a href=" <?= $back ?> "
           style="font-size: 22px;font-weight: bold;">&#8592;</a></span>

            <?php endif; ?>
        </td>
        <td><h1></h1></td>
        <td width=50 style="vertical-align: bottom;">
            <?php
            if ($forth): ?>
                <span class="ssil_uvelich_gl">
        <a href=" <?= $forth ?> " style="font-size: 22px; font-weight: bold;">&#8594</a></span>
            <?php endif; ?>
        </td>
    </tr>
</table>