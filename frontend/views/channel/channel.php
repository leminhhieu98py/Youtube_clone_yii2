<?php

/** @var $channel \common\models\User */
/** @var $dataProvider ActiveDataProvider */

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

?>

<div class="jumbotron">
    <h1 class="display-4"><?= $channel->username ?></h1>
    <hr class="my-4">
    <?php Pjax::begin() ?>
    <?php echo $this->render('_subscribe', [
        'channel' => $channel,
    ]) ?>
    <?php Pjax::end() ?>
</div>

<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '../videos/_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]);

?>