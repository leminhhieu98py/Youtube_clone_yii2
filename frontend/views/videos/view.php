<?php

/** @var $model \common\models\video */

use yii\widgets\Pjax;

?>
<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9 mb-3">
            <video class="embed-responsive-item" poster="<?= $model->getThumbnailLink() ?>" src="<?= $model->getVideoLink() ?> " controls></video>
        </div>
        <h6><?= $model->title ?></h6>
        <div class="d-flex align-items-center justify-content-between">
            <div class="">
                <p class="text-muted m-0"><?= $model->getViews()->count() ?> views • <?= Yii::$app->formatter->asDate($model->created_at) ?></p>
            </div>
            <div class="">
                <?php
                Pjax::begin([])
                ?>
                <?= $this->render('_buttons', [
                    'model' => $model,
                ]) ?>
                <?php
                Pjax::end()
                ?>
            </div>
        </div>
        <hr>
        <div class="col-sm-8 ml-5">
            <a href="" style="text-decoration: none;">
                <h6><?= $model->createdBy->username ?></h6>
            </a>
            <p><?= $model->description ?></p>
        </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>