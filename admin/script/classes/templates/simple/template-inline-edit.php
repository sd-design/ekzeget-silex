<?php if ($settings["numberCol"]) { ?>
    <td colspan = "1"></td>
<?php
}
if ($settings["checkboxCol"]) {
    ?>
    <td colspan = "1"></td>
    <?php }
?>
<td colspan = "1"></td>
<?php
foreach ($data as $row) {
    ?>
    <td class="pdocrud-row-cols">
        <?php echo $row["addOnBefore"]; ?>
        <?php echo $row["element"]; ?>
    <?php echo $row["addOnAfter"]; ?> 
    </td>
<?php }
?>
<td class="pdocrud-row-actions">
    <?php
    if (isset($submitData)) {
        foreach ($submitData as $submit) {
            echo $submit . " ";
        }
    }
    ?>
</td>