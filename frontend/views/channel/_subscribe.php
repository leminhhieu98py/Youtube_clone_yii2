<?php

use yii\helpers\Url;

/** @var $channel commom\models\User */

?>

<a class="
<?= $channel->isSubscribed(Yii::$app->user->id)
    ? 'btn-subcribed'
    : 'btn-subcribe' ?>" href="<?= Url::to(['/channel/subscribe', 'username' => $channel->username]) ?>" role="button" data-method="post" data-pjax="1">
    <?= $channel->isSubscribed(Yii::$app->user->id)
        ? "SUBSCRIBED <i class='far fa-bell-slash ml-2'></i>"
        : "SUBSCRIBE <i class='fas fa-bell ml-2'></i>" ?></a>