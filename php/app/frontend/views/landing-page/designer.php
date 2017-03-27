<?php
/**
 * @var yii\web\View $this
 * @var array        $templates
 */
$this->title = 'Landing Page Designer';
?>
<div class="content animate-panel row">
    <div class="hpanel col-lg-12">
        <div class="panel-body">
            <h2 class="font-light m-b-xs">
                Landing Page Designer
            </h2>
            <small>Step 1 of 2</small>
        </div>
    </div>

    <div class="hpanel col-md-12">
        <div class="panel-body">
            <h3>
                Select Template
            </h3>
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
