<?php
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var string       $template
 */

$this->title = 'Landing Page Designer';
?>
<div class="content animate-panel row">
    <div class="hpanel col-lg-12">
        <div class="panel-body">
            <h2 class="font-light m-b-xs">
                Landing Page Designer
            </h2>
            <small>Step 2 of 2</small>
        </div>
    </div>

    <div class="hpanel col-lg-12">
        <div class="panel-body">
            <h2>
                Customize Template

                <a href="<?= Url::to('/landing-page/designer') ?>" class="btn btn-default btn-sm">
                    Back To Template Selection
                </a>

                <button id="teml_download" class="btn btn-info btn-sm"
                        onclick="document.getElementById('tmpl_frame').contentWindow.download();">
                    Download Template
                </button>
            </h2>

            <iframe style="width: 100%; height: 800px;" src="<?= $template ?>" id="tmpl_frame"></iframe>
        </div>
    </div>
</div>
