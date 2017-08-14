<script type="text/javascript">
    jQuery(document).on("pdocrud_on_load pdocrud_after_submission pdocrud_after_ajax_action", function (event, container) {
        jQuery("<?php echo $elementName; ?>").each(function () {
            var $data = $(this).data();
            $data.valueSpots = {'0:': $data.spotColor};
            jQuery(this).sparkline($data.data || "html", $data,
                    {
                        <?php
                        if (isset($params))
                            echo implode(', ', array_map(
                                            function ($v, $k) {
                                        return $k . ':' . $v;
                                    }, $params, array_keys($params)
                            ));
                        ?>

                    });
        });
    });
</script>    