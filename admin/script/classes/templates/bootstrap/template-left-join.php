<div class="component addrow pull-right">                    
    <div class="control-group">                        
        <div class="controls">
            <a class="pdocrud-actions pdocrud-button pdocrud-button-add-row" href="javascript:;" data-action="add_row">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $lang["add"]; ?>
            </a>
        </div>
    </div>
</div>
<?php
$body = "";
foreach ($data as $rows) {
    $header = "";
    $body .= "<tr>";
    foreach ($rows as $row) {
        $header .= "<th>" . $row["lable"] . $row["tooltip"] . "</th>";
        $body .= "<td>" . $row["element"] . "</td>";
    }
    $body .= ' <td class="text-right"><a href="javascript:;" class="pdocrud-actions" data-action="delete_row"><i class="fa fa-remove"></i> ' . $lang["remove"] . '</a></td>';
    $body .= "</tr>";
}
?>
<table class="table pdocrud-left-join responsive">
    <thead>
        <tr>
            <?php if (isset($header)) echo $header; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($body)) echo $body; ?>
    </tbody>
</table>