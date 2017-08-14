<?php if (!$settings["back_operation"]) { ?>
    <section class="pdocrud-table-container" data-objkey="<?php echo $objKey; ?>" <?php if (!empty($modal)) { ?> data-modal="true"<?php } ?> >
    <?php } ?>
    <div class="panel panel-default">
        <div class="alert alert-success hidden pdocrud_message" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only"><?php echo $lang["message"]; ?> :</span>
            <span class="message_content"><?php if(isset($_SESSION["message"])) echo $_SESSION["message"];?></span>
        </div>
        <div class="page-title clearfix panel-heading pdocrud-table-heading">
            <h3 class="panel-title">
                <?php echo $lang["tableHeading"]; ?>                 
                <small>
                    <?php echo $lang["tableSubHeading"]; ?>
                </small>
            </h3>
            <?php if ($settings["addbtn"]) { ?>
                <div class="btn-group pull-right">
                    <a title="<?php echo $lang["add"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-add green" href="javascript:;" data-action="add" data-obj-key="<?php echo $objKey; ?>">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo $lang["add"]; ?>
                    </a>                    
                </div>
            <?php } ?>
            <?php if ($settings["savebtn"]) { ?>
                <div class="btn-group pull-right">
                    <a title="<?php echo $lang["save"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-save green" href="javascript:;" data-action="save_crud_table_data" data-obj-key="<?php echo $objKey; ?>">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php echo $lang["save"]; ?>
                    </a>                    
                </div>
            <?php } ?>
        </div><!-- /.panel-heading -->

        <div class="panel-body pdocrudbox pdocrud-top-buttons">
            <div class="row">
                <div class="col-sm-6">
                    <?php if ($settings["totalRecordsInfo"]) { ?>
                        <p><?php echo $lang["dispaly_records_info"]; ?></p>
                    <?php } ?>
                </div>
                <div class="col-sm-6 pull-right">                    
                    <div class="pdocrud-search col-sm-12 no-padding">
                        <div class="row">
                            <?php if ($settings["searchbox"]) { ?>
                                <?php echo $searchbox; ?> 
                            <?php } ?>
                            <?php if ($settings["deleteMultipleBtn"]) { ?>
                                <div class="col-xs-1 no-padding">
                                    <a title="<?php echo $lang["delete_selected"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-delete-all green" href="javascript:;" data-action="delete_selected" data-obj-key="<?php echo $objKey; ?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>     
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $data; ?>
                </div>
            </div>
            <div class="row pdocrud-options-files">
                <div class="col-sm-12">
                    <div class="btn-group pull-left pdocrud-export-options">
                        <ul>
                            <?php if ($settings["printBtn"]) { ?>
                                <li><a title="<?php echo $lang["print"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-export" href="javascript:;" data-action="exporttable" data-export-type="print" data-objkey="<?php echo $objKey; ?>"><?php echo $lang["print"]; ?></a></li>
                            <?php
                            }
                            if ($settings["csvBtn"]) {
                                ?> 
                                <li><a title="<?php echo $lang["csv"]; ?>" class="pdocrud-actions pdocrud-button pdocrud-button-export" href="javascript:;" data-action="exporttable" data-export-type="csv" data-objkey="<?php echo $objKey; ?>"><?php echo $lang["csv"]; ?></a></li>
                            <?php
                            }
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
<?php echo $modal; ?>  
<?php if (!$settings["back_operation"]) { ?>
    </section><!-- /.content -->
<?php
}?>