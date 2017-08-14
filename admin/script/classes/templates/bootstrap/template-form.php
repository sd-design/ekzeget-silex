<?php @session_start();?>
<?php if (isset($output)) { ?>
    <form <?php echo $form; ?> >
        <div class="alert alert-danger hidden pdocrud_error" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only"><?php echo $lang["error"]; ?> :</span>
            <span class="error_content"><?php if(isset($_SESSION["error"]) && count($_SESSION["error"])) print_r( $_SESSION["error"]);?></span>
        </div>
        <div class="alert alert-success hidden pdocrud_message" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only"><?php echo $lang["message"]; ?> :</span>
            <span class="message_content"><?php if(isset($_SESSION["message"])) echo $_SESSION["message"];?></span>
        </div>
        <div class="page-title clearfix panel-heading pdocrud-table-heading">
            <h3 class="panel-title">
                <?php if(isset($lang["tableHeading"])){ echo $lang["tableHeading"]; ?>                 
                <small>
                    <?php if(isset($lang["operation"]))  echo $lang["operation"]; ?>
                </small>
                <?php } ?>
            </h3>            
        </div>
        <?php echo $output; ?>
        <?php if ($settings["formtype"] !== "step") { ?>
            <div class="form-group text-center">
                <?php } ?>        
                <?php
                if (isset($submitData)) {
                    foreach ($submitData as $submit) {
                        echo $submit . " ";
                    }
                }
                ?>
                <?php if ($settings["formtype"] !== "step") { ?>
            </div>
        <?php } ?>       
    </form>
<?php } ?>