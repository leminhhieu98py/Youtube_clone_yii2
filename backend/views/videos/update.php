<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Videos */

$this->title = 'Video details';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->video_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="videos-update">

    <h1 class="m-4"><?= Html::encode($this->title) ?></h1>
    <hr class="mb-5">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>