<?php

/** @var $model \common\models\videos */
/** @var $similarVideos \common\models\videos[] */

use common\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
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
            <?php echo Html::channelLink($model->createdBy) ?>
            <p><?= $model->description ?></p>
        </div>
    </div>
    <div class="col-sm-4">
        <?php
        foreach ($similarVideos as $similarVideo) {
        ?>
            <div class="media">
                <a class="mb-4 mr-2" href="<?= Url::to(['/videos/view', 'id' => $similarVideo->video_id]) ?>">
                    <div class="embed-responsive embed-responsive-16by9" style="min-width: 200px; max-width: 300px;">
                        <video style="min-height: 100px;" class="embed-responsive-item" poster="<?= $similarVideo->getThumbnailLink() ?>" src="<?= $similarVideo->getVideoLink() ?> "></video>
                    </div>
                </a>

                <div class="media-body" style="min-width: 100px;">
                    <h6 class="m-0"><?= StringHelper::truncateWords($similarVideo->title, 8) ?></h6>
                    <?php echo Html::channelLink($similarVideo->createdBy) ?>
                    <br class="m-0">
                    <small class="text-muted card-text m-0"><?= $similarVideo->getViews()->count() ?> views • <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></small>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>