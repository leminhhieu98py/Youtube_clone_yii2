<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->beginContent('@backend/views/layouts/base.php')
?>


<?php echo $this->render('_header'); ?>
<main class="d-flex w-50">
    <div class="content-wrapper p-3">
        <?=Alert::widget()?>
        <?=$content?>
    </div>
</main>

<?php $this->endContent()?>