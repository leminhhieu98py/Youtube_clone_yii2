<?php

use common\helpers\Html;
use common\models\User;
use common\models\Videos;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'iTube - Share to be shared';
/** @var $latestVideo common\models\video */
/** @var $numberOfVier integer */
/** @var $numberOfSubscribers integer */
/** @var $latestSubscribers common\models\Subscriber[] */
?>
<h1 class="m-4">Channel dashboard</h1>
<hr class="mb-4">
<div class="site-index d-flex">
    <?php
    $count = Videos::find()
        ->creator(yii::$app->user->identity->id)
        ->published()
        ->count();
    if ($count == 0) { ?>
        <h5 class="card-title m-4 text-danger">You haven't uploaded any videos to display</h5>
    <?php
    } else {
    ?>
        <div class="card m-4 p-3 animate__animated animate__bounceIn" style="width: 20rem;">
            <h5 class="mb-3">Latest video performance</h5>
            <div class="embed-responsive embed-responsive-16by9 mr-3">
                <video class="embed-responsive-item" poster="<?= $latestVideo->getThumbnailLink() ?>" src="<?= $latestVideo->getVideoLink() ?>"></video>
            </div>
            <div class="card-body">
                <h6 class="card-title"><?= StringHelper::truncateWords($latestVideo->title, 10) ?></h6>
                <div class="col-12 d-flex p-0">
                    <p class="text-muted m-1 col-9 text-left p-0">Likes </p>
                    <div class="col-3 text-muted text-right"><?= $latestVideo->getLikes()->count() ?></div>
                </div>
                <div class="col-12 d-flex p-0">
                    <p class="text-muted m-1 col-9 text-left p-0">Dislikes </p>
                    <div class="col-3 text-muted text-right"><?= $latestVideo->getDislikes()->count() ?></div>
                </div>
                <div class="col-12 d-flex p-0">
                    <p class="text-muted m-1 col-9 text-left p-0">Views </p>
                    <div class="col-3 text-muted text-right"><?= $latestVideo->getViews()->count() ?></div>
                </div>
                <a href="<?= Url::to(['/videos/update', 'id' => $latestVideo->video_id]) ?>" class="btn btn-primary mt-3">Edit Video</a>
            </div>
        </div>
        <div class="card m-4 animate__animated animate__bounceIn" style="width: 20rem;">
            <div class="card-body">
                <h5 class="mb-3">Channel analytics</h5>
                <div class="col-12 p-0">
                    <div class="text-muted col-9 text-left p-0 m-0">Current subscribers</div>
                    <div class="col-3 p-0" style="font-size: 24px;"><?= $latestVideo->getViews()->count() ?></div>
                </div>
                <hr class="mt-4 mb-2" style="color: rgb(229,229,229)">
                <h6 class="mb-3">Summary</h6>
                <div class="col-12 d-flex p-0">
                    <p class="text-muted col-9 text-left p-0" style="margin: 4px 0;">Total views </p>
                    <div class="col-3 text-muted text-right"><?= $numberOfView ?></div>
                </div>
                <div class="col-12 d-flex p-0">
                    <p class="text-muted col-9 text-left p-0" style="margin: 4px 0;">Total likes </p>
                    <div class="col-3 text-muted text-right"><?= $totalLikes ?></div>
                </div>
                <div class="col-12 d-flex p-0">
                    <p class="text-muted col-9 text-left p-0" style="margin: 4px 0;">Total dislikes </p>
                    <div class="col-3 text-muted text-right"><?= $totalDislikes ?></div>
                </div>
                <hr class="mt-4 mb-2" style="color: rgb(229,229,229)">
                <h6 class="mb-3">New Subscribers</h6>
                <div class="col-12 p-0">
                    <?php
                    foreach ($latestSubscribers as $latestSubscriber) {
                    ?>
                        <div><?= Html::channelLink($latestSubscriber->user) ?></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card m-4 animate__animated animate__bounceIn" style="width: 30rem; height: 20rem;">
            <div class="card-body">
                <h5 class="mb-3">Ideas for you</h5>
                <div class="text-left p-0 m-0">Protect your channel</div>
                <div class="col-12 d-flex p-0 mt-2">
                    <p class="text-muted col-8 text-left p-0" style="margin: 4px 0;">Your account is at greater risk of attack without 2-Step Verification. Turn it on for extra security</p>
                    <div class="col-4 text-right">
                        <img src="https://www.gstatic.com/youtube/img/promos/growth/7ba192d7e5cd282573e3529f879cdfe7ee46f5ded31080f752eec69be3121dc5_160x160.png" alt="" style="width: 120px;">
                    </div>
                </div>
                <div class="mt-5">
                    <a href="" style="text-decoration: none; font-weight: bold;">GET STARTED</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>