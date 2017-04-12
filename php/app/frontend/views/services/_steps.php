<?php

/**
 * @var integer $stepNow
 */

$steps = [
    1 => 'Select Country',
    2 => 'Select Provider',
    3 => 'Service Info',
];

?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <?php
            foreach ($steps as $key => $step) {
                ?>
                <button class="btn <?= $key !== $stepNow ?: 'btn-primary' ?>">
                    <?= $key . '. ' . $step ?>
                </button>
                <?php
            }
            ?>
        </div>
    </div>
</div>
