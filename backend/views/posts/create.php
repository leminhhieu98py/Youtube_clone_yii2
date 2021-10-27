<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = 'New post';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="posts-form m-4">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'method' => 'get',
            'action' => ['posts/create'],
        ],
    ]); ?>

    <div class="row">
        <div class="col-sm-12 pr-4 video-details">
            <?php echo $form->errorSummary($model) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', [
            'class' => 'btn btn-success',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>