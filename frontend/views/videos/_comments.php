<?php

use common\helpers\Html;
use common\models\User;
?>

<?php
foreach ($comments as $comment) {
    $user = User::find()
        ->andWhere(['id' => $comment->user_id])
        ->one();


?>
    <div class="d-flex w-100">
        <div class="comment-avatar m-3">
            <img class="mr-2" src="<?= $user->getAvatarLink() ?>" alt="avatar">
        </div>
        <div class="w-100">
            <div class="d-block mt-2">
                <?php echo Html::channelLink($user) ?> <span class="text-mute" style="font-weight:350; font-size:14px"> <?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?></span>
            </div>
            <p><?= $comment->content ?></p>
        </div>
    </div>
<?php
}
?>