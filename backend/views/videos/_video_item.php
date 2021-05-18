<!-- @var $model \common\models\Videos -->
<?php

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div class="media">
    <a href="<?= Url::to(['videos/update', 'id' => $model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9 mr-3" style="width: 140px;">
            <video class="embed-responsive-item" poster="<?= $model->getThumbnailLink() ?>" src="<?= $model->getVideoLink() ?>"></video>
        </div>
    </a>
    <div class="media-body">
        <h6 class="mt-0"><?= StringHelper::truncateWords($model->title, 10) ?></h6>
        <?= StringHelper::truncateWords($model->description, 20) ?>
    </div>
</div>