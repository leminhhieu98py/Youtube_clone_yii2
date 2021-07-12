<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;

$this->beginContent('@frontend/views/layouts/base.php');
?>
<?php echo $this->render('_header'); ?>
<main class="d-flex" style="margin-top: 64px;">
    <?php echo $this->render('_sidebar'); ?>

    <div class="main content-wrapper p-4">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?php $this->endContent() ?>