<?php

use yii\widgets\ListView;
use common\models\User;
use common\models\Videos;
use yii\helpers\Url;
use common\helpers\Html;



$this->title = 'iTube - Your library';

?>

<div class="row">

    <!-- Left side - library -->
    <div class="col-lg-10 col-md-9 library-wrapper">
        <div class="col-12 library-title d-flex justify-content-between">
            <a href="<?= Url::to('/videos/history') ?>" class="d-flex align-items-center">
                <div class="aside-nav-link aside-icon-wrapper p-0 text-center mr-2"><i class="fas fa-history"></i></div>
                <div class="aside-nav-link">History</div>
            </a>
            <a href="<?= Url::to('/videos/history') ?>">See all</a>
        </div>
        <hr class="m-4">
        <?php
        echo ListView::widget([
            'dataProvider' => $historyVideos,
            'itemView' => '_video_item',
            'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
            'itemOptions' => [
                'tag' => false,
            ]
        ]);
        ?>

        <div class="col-12 library-title mt-3 d-flex justify-content-between">
            <a href="<?= Url::to('/videos/watchlatervideos') ?>" class="d-flex align-items-center">
                <div class="aside-nav-link aside-icon-wrapper p-0 text-center mr-2"><i class="fas fa-clock"></i></div>
                <div class="aside-nav-link">Watch Later</div>
            </a>
            <a href="<?= Url::to('/videos/watchlatervideos') ?>">See all</a>
        </div>
        <hr class="m-4">
        <?php
        echo ListView::widget([
            'dataProvider' => $watchLaterVideos,
            'itemView' => '_video_item',
            'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
            'itemOptions' => [
                'tag' => false,
            ]
        ]);

        ?>

        <div class="col-12 library-title mt-3 d-flex justify-content-between">
            <a href="<?= Url::to('/videos/likedvideos') ?>" class="d-flex align-items-center">
                <div class="aside-nav-link aside-icon-wrapper p-0 text-center mr-2"><i class="fas fa-thumbs-up"></i></div>
                <div class="aside-nav-link">Liked Videos</div>
            </a>
            <a href="<?= Url::to('/videos/likedvideos') ?>">See all</a>
        </div>
        <hr class="m-4">
        <?php
        echo ListView::widget([
            'dataProvider' => $watchLaterVideos,
            'itemView' => '_video_item',
            'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
            'itemOptions' => [
                'tag' => false,
            ]
        ]);

        ?>
    </div>

    <!-- Right side - some statistics -->
    <div class="col-lg-2 col-md-3">
        <?php
            $user = User::find()
            ->andWhere(['id' => Yii::$app->user->identity->id])
            ->one();
        ?>
        <div class="statistics-wrapper">
            <div class="text-center">
                <img class="mr-2 avatar" src="<?= $user->getAvatarLink() ?>" alt="avatar">
            </div>
            <p class="mt-3 text-center mb-4"><?php echo Html::channelLink($user) ?></p>
            <hr class="statistic-hr">
            <div class="statistic-title-wrapper">
                <p>Subscriptions</p>
                <p><?= $channel->getSubscribes()->count() ?></p>
            </div>
            <hr class="statistic-hr">
            <div class="statistic-title-wrapper">
                <p>Uploads</p>
                <p><?= count($videos) ?></p>
            </div>
            <hr class="statistic-hr">
            <div class="statistic-title-wrapper">
                <p>Likes</p>
                <p><?= $totalLikes ?></p>
            </div>
            <hr class="statistic-hr">
        </div>
    </div>
</div>