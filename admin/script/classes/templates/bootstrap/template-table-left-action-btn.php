<div class="table-responsive">
    <table class="table pdocrud-table table-bordered table-striped table-condensed" data-obj-key="<?php echo $objKey; ?>">
        <?php if ($settings["headerRow"]) { ?>
        <thead>
            <tr class="pdocrud-header-row">
                <?php if ($settings["actionbtn"]) {
                    ?>
                    <th>
                        <?php echo $lang["actions"] ?>
                    </th>
                <?php }
                if ($settings["numberCol"]) { ?>
                <th class="w1">
                        #
                    </th>
                <?php }
                if ($settings["checkboxCol"]) { ?>
                    <th class="w1">
                        <input type="checkbox" value="select-all" name="pdocrud_select_all" class="pdocrud-select-all"  />
                    </th>
                <?php }
                if ($columns) foreach ($columns as $colkey => $column) { 
                    if(!in_array($column["col"], $colsRemove)){
                    ?>
                        <th <?php echo $column["attr"]; ?> data-action="<?php echo $column["sort"]; ?>"  data-sortkey="<?php echo $colkey; ?>" class="pdocrud-actions-sorting pdocrud-<?php echo $column["sort"]; ?>">
                            <span> <?php echo $column["colname"];
                            echo $column["tooltip"];
                            ?>
                            </span>
                        </th>
                    <?php }
                }
                ?>
            </tr>
        </thead>
        <?php } ?>
        <tbody>
        <input type="hidden" value="<?php echo $objKey; ?>" class="pdocrud-hidden-data pdoobj" />
        <?php
        $rowcount = $settings["row_no"];
        if ($data)
            foreach ($data as $rows) {
            $sumrow = false;
                ?>
                <tr id="pdocrud-row-<?php echo $rowcount; ?>" class="pdocrud-data-row <?php if(isset($rows[0]["class"])) echo $rows[0]["class"]; ?>" <?php if(isset($rows[0]["style"])) echo $rows[0]["style"]; ?>>
                     <?php if($sumrow){
                        ?>
                         <td class="pdocrud-row-actions"></td>
                        <?php continue;                    
                    }
                    if (is_array($btnActions) && count($btnActions)) {
                        ?>
                       <td class="pdocrud-row-actions">
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
                       </td>
                    <?php } ?>
                   <?php  if ($settings["numberCol"]) { ?>
                    <td class="pdocrud-row-count">
                    <?php echo $rowcount + 1; ?>
                    </td>
                   <?php } if ($settings["checkboxCol"]) { ?>
                    <td class="pdocrud-row-actions">
                        <input type="checkbox" class="pdocrud-select-cb" value="<?php echo $rows[$pk]; ?>" />
                    </td>
                    <?php }
                    foreach ($rows as $col => $row) {
                         if(!in_array($col, $colsRemove)){
                        if (is_array($row)) {
                            ?>    
                            <td class="pdocrud-row-cols <?php if(isset($row["class"])) echo $row["class"]; ?>"  <?php if(isset($row["style"])) echo $row["style"]; ?>>
                            <?php if(isset($row["sum_type"])) { echo $lang[$row["sum_type"]]; $sumrow = true; }?>
                            <?php echo $row["content"]; ?>
                            </td>
                            <?php
                        } else {
                            ?>    
                            <td class="pdocrud-row-cols">
                            <?php echo $row; ?>
                            </td>
                            <?php
                        }
                      }
                    }
                     ?>       
                </tr>
                <?php
                $rowcount++;
            } else {
            ?>
            <tr class="pdocrud-data-row">
                <td class="pdocrud-row-count" colspan="<?php echo count($columns); ?>">
                <?php echo $lang["no_data"] ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
         <?php if ($settings["footerRow"]) { ?>
        <tfoot>
            <tr class="pdocrud-header-row">
               <?php if ($settings["actionbtn"]) {
                    ?>
                    <th>
                    <?php echo $lang["actions"] ?>
                    </th>
               <?php }
                 if ($settings["numberCol"]) { ?>
                    <th class="w1">
                        #
                    </th>
                <?php } if ($settings["checkboxCol"]) { ?>
                    <th class="w1">
                        <input type="checkbox" value="select-all" name="pdocrud_select_all" class="pdocrud-select-all"  />
                    </th>
                <?php } ?>
                <?php if ($columns) foreach ($columns as $colkey => $column) { 
                    if(!in_array($column["col"], $colsRemove)){
                    ?>
                        <th <?php echo $column["attr"]; ?> data-action="<?php echo $column["sort"]; ?>"  data-sortkey="<?php echo $colkey; ?>" class="pdocrud-actions-sorting pdocrud-<?php echo $column["sort"]; ?>">
                            <?php echo $column["colname"];
                            echo $column["tooltip"];
                            ?>
                        </th>
                    <?php }
                }
                 ?>
            </tr>
        </tfoot>
         <?php } ?>
    </table>
</div>