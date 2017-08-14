<div class="row pdocrud-filters-container" data-objkey="<?php echo $objKey; ?>" >
    <div class="col-sm-3">
        <?php if (isset($filters) && count($filters)) { ?>
            <div class="pdocrud-filters-options">
                <div class="pdocrud-filter-selected">
                    <span class="pdocrud-filter-option-remove"><?php echo $lang["clear_all"] ?></span>
                </div>
                <?php
                foreach ($filters as $filter) {
                    echo $filter;
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="col-sm-9">
        <?php echo $data ?>
    </div>
</div>