<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;

$this->beginContent('@frontend/views/layouts/base.php')
?>


<main class="d-flex justify-content-center">
    <div class="content-wrapper p-5">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endContent() ?>