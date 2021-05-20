<?php

use yii\helpers\Url;

/** @var $channel commom\models\User */

?>

<a class="btn <?= $channel->isSubscribed(Yii::$app->user->id) ? 'btn-secondary' : 'btn-danger' ?>" href="<?= Url::to(['/channel/subscribe', 'username' => $channel->username]) ?>" role="button" data-method="post" data-pjax="1">Subcribe <i class="far fa-bell"></i></a> <?= $channel->getSubscribes()->count() ?>