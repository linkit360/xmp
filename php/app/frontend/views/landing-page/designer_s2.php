<?php
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var string       $template
 */

$this->title = 'Landing Page Designer';
?>
<script type="text/javascript">
    function done() {
        document.getElementById('tmpl_load').style.display = "none";
        document.getElementById('tmpl_frame').style.display = "block";
    }
</script>

<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <h2 class="font-light m-b-xs">
                        Landing Page Designer
                    </h2>
                    <small>Step 2 of 2</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="hpanel">
                <div class="panel-body">
                    <h2>
                        Customize Template

                        <a href="<?= Url::to('/landing-page/designer') ?>" class="btn btn-default">
                            Back To Template Selection
                        </a>

                        <button id="teml_download"
                                onclick="document.getElementById('tmpl_frame').contentWindow.download();"
                                class="btn btn-info">
                            Download Template
                        </button>
                    </h2>

                    <div id="tmpl_load">
                        Loading...
                    </div>

                    <iframe style="width: 100%; height: 800px; display: none;" src="<?= $template ?>" onload="done();"
                            id="tmpl_frame">

                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
