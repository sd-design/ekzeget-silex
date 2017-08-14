<div class="pdocrud-table" data-obj-key="<?php echo $objKey; ?>">
    <input type="hidden" value="<?php echo $objKey; ?>" class="pdocrud-hidden-data pdoobj" />
    <?php
    $row_count = 0;
    $bootstrap_col = 12/$colPerRow;
    if ($data)
        foreach ($data as $rows) {
            if( $row_count % $colPerRow === 0 )
             echo "<div id=\"pdocrud_portfolio_$row_count\" class=\"row pdocrud-portfolio-row\">";
            ?>
                <div class="col-xs-<?php echo $bootstrap_col?> pdocrud-portfolio-col">
                <?php
                foreach ($rows as $col => $row) {
                    if(!in_array($col, $colsRemove)){
                         if (is_array($row)) {
                             ?>
                            <div class="pdocrud-portfolio-col-data <?php if(isset($row["class"])) echo $row["class"]; ?>"  <?php if(isset($row["style"])) echo $row["style"]; ?>>
                            <?php if(isset($row["sum_type"])) { echo $lang[$row["sum_type"]]; $sumrow = true; }?>
                            <?php echo $row["content"]; ?>
                            </div>
                            <?php
                         }
                         else{
                             ?>    
                            <div class="pdocrud-portfolio-col-data">
                            <?php echo $row; ?>
                            </div>
                            <?php
                             
                         }
                    }
                }
                    if (is_array($btnActions) && count($btnActions)) {
                        ?>
                       <div  class="pdocrud-row-actions">
                        <?php foreach ($btnActions as  $action_name => $action) { 
                            list( $key, $colName, $action_val, $type, $text, $attr, $url) = $action;
                            $columnVal = isset($rows[$colName]) ? $rows[$colName] : "";
                            $url =  preg_replace('/{[^}]+}/', $rows[$pk], $url);
                            if (is_array($text) && isset($text[$rows[$colName]]))
                                $action_text = $text[$rows[$colName]];
                            else 
                                $action_text = $text;
                            
                            ?>
                           <a class="pdocrud-actions pdocrud-button pdocrud-button-<?php echo $action_name;?>"
                             href="<?php echo $url;?>"
                             <?php
                            echo implode(', ', array_map(
                                            function ($v, $k) {
                                        return $k . '=' . $v;
                                    }, $attr, array_keys($attr)
                            )); ?>  
                            data-id="<?php echo $rows[$pk]; ?>" 
                            data-column-val="<?php echo $columnVal ?>"
                            data-unique-id="<?php echo $key; ?>" 
                            data-action="<?php echo $action_name;?>"><?php echo $action_text; ?>
                           </a>
                       <?php } ?>
                       </div>
                    <?php } ?> 
                </div>
                <?php
               $row_count++;
                if( $row_count !=0 && $row_count % $colPerRow === 0 )
                echo "</div>";
            }
    ?>
</div>