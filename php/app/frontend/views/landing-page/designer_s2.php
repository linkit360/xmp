<?php
/**
 * @var yii\web\View $this
 * @var string       $template
 */
$this->title = 'LANDING PAGE DESIGNER';
?>
<script type="text/javascript">
    function done() {
        document.getElementById('tmpl_load').style.display = "none";
        document.getElementById('tmpl_frame').style.display = "block";
    }
</script>

<h3>
    Step 2 of 2: Customize Template
</h3>

<a href="/landing-page/designer" class="md-btn md-btn-simple md-btn-wave-light waves-effect waves-button waves-light">
    Back To Template Selection
</a>
<br/><br/>

<button id="teml_download" onclick="document.getElementById('tmpl_frame').contentWindow.download();"
        class="md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light">
    Download Template
</button>
<br/><br/>

<div id="tmpl_load">
    Loading...
</div>

<iframe style="width: 100%; height: 800px; display: none;" src="<?= $template ?>" onload="done();" id="tmpl_frame">

</iframe>
