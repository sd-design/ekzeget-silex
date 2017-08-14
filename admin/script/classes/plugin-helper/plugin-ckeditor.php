<script type="text/javascript">
    jQuery(document).on("pdocrud_on_load pdocrud_after_submission pdocrud_after_ajax_action", function (event, container) {
        CKEDITOR.replace("<?php echo $elementName; ?>" );
    });
</script>    