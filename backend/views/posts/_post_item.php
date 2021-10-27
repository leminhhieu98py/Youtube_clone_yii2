<!-- @var $model \common\models\Posts -->
<?php

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div class="media">
    <a href="<?= Url::to(['posts/update', 'id' => $model->post_id]) ?>">
        <img class="mr-3" src="<?= $model->getImageLink() ?>" alt="" style="width: 140px;">
    </a>
    <div class="media-body">
        <?= StringHelper::truncateWords($model->post_description, 40) ?>
    </div>
</div>