<?php

use common\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/** @var $model \common\models\Videos */
?>

<div class="card m-4 border-0 animate__jackInTheBox animate__animated" style="width: 20rem;">
    <a href="<?= Url::to(['/videos/view', 'id' => $model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" poster="<?= $model->getThumbnailLink() ?>" src="<?= $model->getVideoLink() ?>"></video>
        </div>
    </a>
    <div class="card-body p-2 row m-0">
        <div class="_video_item_img_wrapper col-2 p-0">
            <img src="<?= $model->createdBy->getAvatarLink() ?>" alt="avatar">
        </div>
        <div class="col-10 p-0">
            <h6 class="card-title m-0"><?= StringHelper::truncateWords($model->title, 10) ?></h6>
            <?php echo Html::channelLink($model->createdBy) ?>
            <p class="text-muted card-text m-0"><?= $model->getViews()->count() ?> views <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></p>
        </div>
    </div>
</div>