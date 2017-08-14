<script type="text/javascript">
    jQuery(document).on("pdocrud_on_load pdocrud_after_submission pdocrud_after_ajax_action", function (event, container) {
    jQuery("<?php echo $elementName; ?>").fullCalendar(
			<?php echo json_encode($params, JSON_PRETTY_PRINT);?>
		);
    });
     
</script>    