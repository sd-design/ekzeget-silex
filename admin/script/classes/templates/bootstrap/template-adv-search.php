<?php if (isset($advSearch)) { ?>
    <form class="pdocrud-adv-search-form">
        <div class="pdocrud-adv-search-container" data-objkey="<?php echo $objKey; ?>" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?php echo $lang["advance_search"];?> </h4>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($advSearch as $search) { ?>
                                <div class="form-group col-sm-3 validating" id="course">
                                    <?php echo $search["lable"]; ?>
                                    <?php echo $search["element"]; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" class="pdoobj" value="<?php echo $objKey; ?>" />
    </form>
<?php } ?>