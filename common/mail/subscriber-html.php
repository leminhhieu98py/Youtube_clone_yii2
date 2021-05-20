<?php

/** @var $channel \common\models\User */

use common\helpers\Html;

/** @var $user \common\models\User */

?>
<p>Dear <?= $channel->username ?>,</p>
<p>User <?php echo Html::channelLink($user) ?> has subcribed to your channel</p>
<p>From iTube team</p>