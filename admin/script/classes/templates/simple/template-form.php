<?php if (isset($output)) { ?>
    <form <?php echo $form; ?> >
        <div class="alert alert-danger hidden pdocrud_error" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <span class="error_content"></span>
        </div>
        <div class="alert alert-success hidden pdocrud_message" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Message:</span>
            <span class="message_content"></span>
        </div>
        <fieldset>
            <legend></legend>
            <?php echo $output;?>
            <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4 center-block">
                        <?php
                        if (isset($submitData)) {
                            foreach ($submitData as $submit) {
                                echo $submit . " ";
                            }
                        }
                        ?>
                    </div>
                </div>
        </fieldset>
    </form>
<?php } ?>