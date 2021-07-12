<?php

/** @var $model \common\models\videos */
/** @var $similarVideos \common\models\videos[] */

use common\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\User;

$this->title = "iTube - $model->title";

if (isset(Yii::$app->user->identity->id)) {
    $user = User::find()
        ->andWhere(['id' => Yii::$app->user->identity->id])
        ->one();
}
?>
<input type="hidden" class="baseUrl" value="<?= Url::base() . '/' . Yii::$app->controller->id ?>">
<div class="row m-4 ml-5">

    <!-- Left side -->
    <div class="col-sm-8">

        <!-- Main video -->
        <div class="embed-responsive embed-responsive-16by9 mb-3">
            <video class="embed-responsive-item" poster="<?= $model->getThumbnailLink() ?>" src="<?= $model->getVideoLink() ?>" autoplay controls></video>
        </div>

        <!-- Title, like, dislike,... -->
        <h5><?= $model->title ?></h5>
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

        <!-- channel and description -->
        <div class="row m-0 w-100 d-flex flex-wrap">
            <div class="view-img-wrapper d-flex justify-content-center col-1 p-0">
                <img src="<?= $model->createdBy->getAvatarLink() ?>" alt="avatar">
            </div>
            <div class="col-2">
                <div>
                    <?php echo Html::channelLink($model->createdBy) ?>
                </div>
                <p class="text-muted"><?= $model->createdBy->getSubscribes()->count() ?> <?= ($model->createdBy->getSubscribes()->count() > 1) ? 'subscribers' : 'subscriber' ?></p>
            </div>
            <div class="col-9 text-right p-0">
                <?php Pjax::begin() ?>
                <?php echo $this->render('../channel/_subscribe', [
                    'channel' => $model->createdBy,
                ]) ?>
                <?php Pjax::end() ?>
            </div>
            <div class="col-1"></div>
            <div class="col-11 mt-3">
                <p><?= $model->description ?></p>
            </div>
        </div>

        <!-- Comment -->
        <hr>
        <div class="m-0 w-100">
            <?= $this->render('_comment_count', [
                'comments' => $comments
            ]); ?>
            <div class="d-flex align-items-center mb-3">
                <div class="m-3 comment-avatar">
                    <img src="<?php
                                if (isset($user)) {
                                    echo $user->getAvatarLink();
                                } else {
                                    echo "https://lh3.googleusercontent.com/proxy/nO0hrtMIkXkvSRHr8AUcHtXYaz1iCuwGRtO__amTtwwVmouJsCcvvyqGlgR38uBoi5v8kxJnZj0N41O461nBVch1e7lczD4";
                                }  ?>" alt="avatar">
                </div>
                <div id="comment-input-wrapper" class="w-100">
                    <input class="w-100" type="text" placeholder="Add a public comment..." id="comment-input" data-videoid="<?= $model->video_id ?>">
                </div>
            </div>
        </div>
        <div class="m-0 w-100 comment-wrapper">

        </div>
    </div>

    <!-- Right side -->
    <div class="col-sm-4">
        <?php
        foreach ($similarVideos as $similarVideo) {
        ?>
            <div class="media animate__animated animate__fadeInUp">
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