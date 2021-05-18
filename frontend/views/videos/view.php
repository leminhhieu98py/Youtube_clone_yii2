<?php

/** @var $model \common\models\video */

?>
<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9 mb-3">
            <video class="embed-responsive-item" poster="<?= $model->getThumbnailLink() ?>" src="<?= $model->getVideoLink() ?> " controls></video>
        </div>
        <h6><?= $model->title ?></h6>
        <p class="text-muted">140 views - <?= Yii::$app->formatter->asDate($model->created_at) ?></p>
    </div>
    <div class="col-sm-4">
    </div>
</div>