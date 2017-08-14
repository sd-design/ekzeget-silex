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
                                <?php if (isset($columns[$col])) echo $columns[$col]["colname"];
                                        else echo $col; ?>
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
                                            <?php if (isset($columns[$col])) echo $columns[$col]["colname"];
                                                else echo $col; ?>
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
                    <td><div class="pdocrud-action-buttons pdocrud-print-hide">
                            <button data-action="print" class="btn btn-info pdocrud-form-control pdocrud-button pdocrud-view-print" type="button"><?php echo $lang["print"] ?></button>
                        </div>
                    </td>
                    <td class="text-right"><div class="pdocrud-action-buttons">
                            <button data-action="back" data-dismiss="modal" class="btn btn-info pdocrud-form-control pdocrud-button pdocrud-back" type="button"><?php echo $lang["back"] ?></button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>