<section class="pdocrud-table-container" data-objkey="<?php echo $objKey; ?>" <?php if (!empty($modal)) { ?> data-modal="true"<?php } ?> >
    <div class="panel panel-default">
        <div class="page-title clearfix panel-heading pdocrud-table-heading">
            <h3 class="panel-title">
                <?php echo $lang["tableHeading"]; ?>                 
                <small>
                    <?php echo $lang["tableSubHeading"]; ?>
                </small>
            </h3>

        </div><!-- /.panel-heading -->
        <div class="panel-body pdocrudbox pdocrud-top-buttons">
            <div class="row">
                <div class="col-sm-6">
                    <?php if ($settings["totalRecordsInfo"]) { ?>
                        <p><?php echo $lang["dispaly_records_info"]; ?></p>
                    <?php } ?>
                </div>
                <div class="col-sm-6 pull-right">                    
                   
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table pdocrud-table table-bordered table-striped table-condensed" data-obj-key="<?php echo $objKey; ?>">
                            <?php if ($settings["headerRow"]) { ?>
                                <thead>
                                    <tr class="pdocrud-header-row">
                                        <?php if ($settings["numberCol"]) { ?>
                                            <th class="w1">
                                                #
                                            </th>
                                        <?php } ?>
                                        <?php if ($columns) foreach ($columns as $colkey => $column) { ?>
                                                <th <?php echo $column["attr"]; ?> data-action="<?php echo $column["sort"]; ?>"  data-sortkey="<?php echo $colkey; ?>" class="pdocrud-actions-sorting pdocrud-<?php echo $column["sort"]; ?>">
                                                    <?php
                                                    echo $column["colname"];
                                                    echo $column["tooltip"];
                                                    ?>
                                                </th>
        <?php } ?>
                                    </tr>
                                </thead>
<?php } ?>
                            <tbody>
                            <input type="hidden" value="<?php echo $objKey; ?>" class="pdocrud-hidden-data pdoobj" />
                            <?php
                            $rowcount = 0;
                            if ($data)
                                foreach ($data as $rows) {
                                    ?>
                                    <tr id="pdocrud-row-<?php echo $rowcount; ?>" class="pdocrud-data-row">
                                            <?php if ($settings["numberCol"]) { ?>
                                            <td class="pdocrud-row-count">
                                            <?php echo $rowcount + 1; ?>
                                            </td>
                                        <?php } ?>
                                        <?php
                                        foreach ($rows as $col => $row) {
                                            if (is_array($row)) {
                                                ?>    
                                                <td class="pdocrud-row-cols <?php echo $row["class"]; ?>"  <?php echo $row["style"]; ?>>
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
    <?php if ($settings["numberCol"]) { ?>
                                            <th class="w1">
                                                #
                                            </th>
                                            <?php } ?>
                                            <?php if ($columns) foreach ($columns as $colkey => $column) { ?>
                                                <th <?php echo $column["attr"]; ?> data-action="<?php echo $column["sort"]; ?>" data-sortkey="<?php echo $colkey; ?>" class="pdocrud-actions-sorting">
                                                    <?php
                                                    echo $column["colname"];
                                                    echo $column["tooltip"];
                                                    ?>
                                                </th>
                                    <?php } ?>
                                    </tr>
                                </tfoot>
<?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row pdocrud-options-files">
                <div class="col-sm-12">
                    <div class="btn-group pull-left pdocrud-export-options">
                        <ul>
                            <?php if ($settings["printBtn"]) { ?>
                                <li><a title="<?php echo $lang["print"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-export" href="javascript:;" data-action="exporttable" data-export-type="print" data-objkey="<?php echo $objKey; ?>"><?php echo $lang["print"]; ?></a></li>
                            <?php }
                            if ($settings["csvBtn"]) {
                                ?> 
                                <li><a title="<?php echo $lang["csv"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-export" href="javascript:;" data-action="exporttable" data-export-type="csv" data-objkey="<?php echo $objKey; ?>"><?php echo $lang["csv"]; ?></a></li>
                            <?php }
                            if ($settings["pdfBtn"]) {
                                ?>
                                <li><a title="<?php echo $lang["pdf"]; ?>"class="pdocrud-actions pdocrud-button pdocrud-button-export" href="javascript:;" data-action="exporttable" data-export-type="pdf" data-objkey="<?php echo $objKey; ?>"> <?php echo $lang["pdf"]; ?></a></li>                            
                    <?php } if ($settings["excelBtn"]) { ?>
                                <li><a title="<?php echo $lang["excel"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-export" href="javascript:;" data-action="exporttable" data-export-type="excel" data-objkey="<?php echo $objKey; ?>"><?php echo $lang["excel"]; ?></a></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <?php if ($settings["recordsPerPageDropdown"]) { ?>
                        <div class="btn-group pull-right">
                            <?php echo $perPageRecords; ?>
                        </div>
                    <?php } ?>
                        <?php if ($settings["pagination"]) { ?>
                        <div class="btn-group pull-right pdocrud-pagination">
                            <?php echo $pagination; ?>
                        </div>
                         <?php } ?>
                    <div style="clear:both"></div>
                </div>  </div>  
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section><!-- /.content -->