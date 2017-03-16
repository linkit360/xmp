<?php
/**
 * @var yii\web\View $this
 * @var array        $templates
 */
$this->title = 'Landing Page Designer';
?>
<h3>
    Step 1 of 2
</h3>

<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
                Select Template
            </div>
            <div class="panel-body">
                <?php
                foreach ($templates as $template) {
                    $link = '?t=' . $template;
                    ?>
                    <div style="float: left; padding: 10px; text-align: center;">
                        <a href="<?= $link ?>">
                            Template #<?= $template ?><br/>
                            <img src="/lp/templates/<?= $template ?>/preview.png" style="width: 200px;" border="0"/>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
