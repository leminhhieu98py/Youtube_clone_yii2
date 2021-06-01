<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;

$this->beginContent('@backend/views/layouts/base.php');
?>
<?php echo $this->render('_header'); ?>
<main class="d-flex">
    <div class="content-wrapper p-4">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?php $this->endContent() ?>