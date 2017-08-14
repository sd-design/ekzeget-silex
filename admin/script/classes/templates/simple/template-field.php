<?php
foreach ($data as $row) {
    $group = $row["group"];
    if ($group === 0 || $group === "start") {
        ?>
        <div class="form-group">
        <?php } 
        if ($group === "start") {
        ?>
        <div class="row">
        <?php } ?>
              <?php if (!empty($row["blockClass"])) { ?> 
            <div class="<?php echo $row["blockClass"] ?>">
            <?php } ?>
            <?php echo $row["lable"] ?>  <?php echo $row["tooltip"]; ?> 
            <?php if (!empty($row["horizontalblockClass"])) { ?> 
            <div class="<?php echo $row["horizontalblockClass"] ?>">
            <?php } ?>
            <?php if (!empty($row["addOnBefore"]) || !empty($row["addOnAfter"])) { ?> 
                <div class="input-group">
                <?php } ?>
                <?php echo $row["addOnBefore"]; ?>
                <?php echo $row["element"]; ?>
                <?php echo $row["addOnAfter"]; ?> 
                <?php if (!empty($row["addOnBefore"]) || !empty($row["addOnAfter"])) { ?> 
                </div>
            <?php } ?>
            <?php echo $row["desc"]; ?>
            <?php if (!empty($row["horizontalblockClass"])) { ?> </div><?php } ?>    
            <?php if (!empty($row["blockClass"])) { ?> </div><?php } ?>
        <?php if ($group === "end") { ?> </div> <?php } ?>
        <?php if (($group === 0 || $group === "end")) { ?> </div> <?php } ?>
    <?php
}