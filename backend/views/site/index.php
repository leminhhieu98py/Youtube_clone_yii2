<?php

use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'iTube - Share to be shared';
/** @var $latestVideo common\models\video */
/** @var $numberOfVier integer */
/** @var $numberOfSubscribers integer */
/** @var $latestSubscribers common\models\Subscriber[] */
?>
<div class="site-index d-flex">
    <div class="card m-4" style="width: 18rem;">
        <div class="embed-responsive embed-responsive-16by9 mr-3">
            <video class="embed-responsive-item" poster="<?= $latestVideo->getThumbnailLink() ?>" src="<?= $latestVideo->getVideoLink() ?>"></video>
        </div>
        <div class="card-body">
            <h6 class="card-title"><?= StringHelper::truncateWords($latestVideo->title, 10) ?></h6>
            <p class="card-text">Likes: <?= $latestVideo->getLikes()->count() ?></p>
            <p class="card-text">Dislikes: <?= $latestVideo->getDislikes()->count() ?></p>
            <p class="card-text">Views: <?= $latestVideo->getViews()->count() ?></p>
            <a href="<?= Url::to(['/videos/update', 'id' => $latestVideo->video_id]) ?>" class="btn btn-primary">Edit Video</a>
        </div>
    </div>
    <div class="card m-4" style="width: 18rem;">
        <div class="card-body">
            <h6 class="card-title">Summary your channel: </h6>
            <p class="card-text">Total views: <?= $numberOfView ?></p>
            <p class="card-text">Total likes: <?= $numberOfView ?></p>
            <p class="card-text">Total dislikes: <?= $numberOfView ?></p>
            <p class="card-text">Total subscribers: <?= $numberOfSubscribers ?></p>
        </div>
    </div>
    <div class="card m-4" style="width: 18rem;">
        <div class="card-body">
            <h6 class="card-title">New Subscribers: </h6>
            <?php
            foreach ($latestSubscribers as $latestSubscriber) {
            ?>
                <div><?= $latestSubscriber->user->username ?></div>
            <?php
            }
            ?>
        </div>
    </div>
</div>