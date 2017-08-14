<section class="pdocrud-table-container" data-objkey="<?php echo $objKey; ?>">
    <div id="pdocrud-table-view table-responsive">
        <table class="pdocrud-table pdocrud-table-view table table-bordered table-striped table-condensed">            
            <tbody>
                <?php
                foreach ($data as $rows) {
                    foreach ($rows as $col => $row) {
                        ?>
                        <tr>
                            <td>
                                <?php if (isset($columns[$col]))
                                    echo $columns[$col]["colname"];
                                else
                                    echo $col;
                                ?>
                            </td>
                            <td>
                        <?php echo $row; ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if (count($leftJoinData)) {
                    $key = array_keys($leftJoinData);
                    $loop = 0;
                    foreach ($leftJoinData as $data) {
                        foreach ($data as $rows) {
                            if ($loop === 0) {
                                $leftCols = array_keys($rows);
                                ?>
                                <tr>
                                        <?php
                                        foreach ($leftCols as $col) {
                                            ?>
                                        <td>
                                        <?php if (isset($columns[$col]))
                                            echo $columns[$col]["colname"];
                                        else
                                            echo $col;
                                        ?>
                                        </td>

                                    <?php }
                                    ?>
                                </tr> 
                                    <?php } $loop++;
                                    ?>
                            <tr>
                                <?php foreach ($rows as $row) {
                                    ?>  
                                    <td>
                                <?php echo $row; ?>
                                    </td>
                            <?php }
                            ?>
                            </tr>
                                <?php
                            }
                        }
                    }
                    ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>                       
                        <div class="pdocrud-action-buttons pdocrud-print-hide">
                             <?php if (isset($settings["viewPrintButton"]) && $settings["viewPrintButton"] === true) { ?>
                            <button data-action="print" class="btn btn-info pdocrud-form-control pdocrud-button pdocrud-view-print" type="button"><?php echo $lang["print"] ?></button>
                            <?php } ?>
                            <?php if (isset($settings["viewDelButton"]) && $settings["viewDelButton"] === true) { ?>
                            <button class="btn btn-info pdocrud-form-control pdocrud-button pdocrud-view-delete" data-id="<?php echo $id;?>" data-action="delete" type="button"><?php echo $lang["delete"] ?></button>
                             <?php } ?>
                        </div>                       
                    </td>
                    <td class="text-right">                        
                        <div class="pdocrud-action-buttons pdocrud-button-delete">
                            <?php if (isset($settings["viewEditButton"]) && $settings["viewEditButton"] === true) { ?>
                            <button class="btn btn-info pdocrud-form-control pdocrud-button pdocrud-view-edit" data-id="<?php echo $id;?>" data-action="edit" type="button"><?php echo $lang["edit"] ?></button>
                            <?php } ?>
                            <?php if (isset($settings["viewBackButton"]) && $settings["viewBackButton"] === true) { ?>
                             <button data-action="back" data-dismiss="modal" class="btn btn-info pdocrud-form-control pdocrud-button pdocrud-back" type="button"><?php echo $lang["back"] ?></button>
                            <?php } ?>
                        </div>                         
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>