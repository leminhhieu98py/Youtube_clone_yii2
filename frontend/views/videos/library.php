<?php

use yii\widgets\ListView;
use yii\helpers\Url;


$this->title = 'iTube - Your library';

?>

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