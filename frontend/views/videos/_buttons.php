<?php

use yii\helpers\Url;

/** @var $model common\models\videos */
?>

<a class="btn btn-sm 
<?= $model->isLikedBy(Yii::$app->user->id)
    ? 'btn-outline-primary'
    : 'btn-outline-secondary' ?>" href="<?= Url::to(['/videos/like', 'id' => $model->video_id]) ?>" data-method="post" data-pjax="1"><i class="fas fa-thumbs-up">
    </i> <?= $model->getLikes()->count() ?>
</a>
<a class="btn btn-sm <?= $model->isDislikedBy(Yii::$app->user->id)
                            ? 'btn-outline-danger'
                            : 'btn-outline-secondary' ?>" href="<?= Url::to(['/videos/dislike', 'id' => $model->video_id]) ?>" data-method="post" data-pjax="1">
    <i class="fas fa-thumbs-down"></i> <?= $model->getDislikes()->count() ?>
</a>
<div class="btn btn-sm btn-outline-secondary hinge-btn">
    <i class="fas fa-share-alt"> SHARE</i>
</div>
<div class="btn btn-sm btn-outline-secondary hinge-btn">
    <i class="fas fa-save"> SAVE</i>
</div>
<div class="btn btn-sm btn-outline-secondary hinge-btn">
    <i class="fas fa-ellipsis-h"></i>
</div>