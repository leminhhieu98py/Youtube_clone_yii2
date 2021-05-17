<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Videos */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
]);?>

    <div class="row">
        <div class="col-sm-8">
            <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
            <?=$form->field($model, 'description')->textarea(['rows' => 6])?>
            <?=$form->field($model, 'tags')->textInput(['maxlength' => true])?>

            <div class="form-group">
                <label><?=$model->getAttributeLabel('thumbnail')?></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                    <label class="custom-file-label" for="thumbnail">Choose file</label>
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="embed-responsive embed-responsive-16by9 mb-3">
                <video class="embed-responsive-item" poster="<?=$model->getThumbnailLink()?>"
                    src="<?=$model->getVideoLink()?>" controls></video>
            </div>
            <div class="mb-3">
                <div class="text-muted">Video Link:</div>
                <a href="<?php echo $model->getVideoLink() ?>">Click here</a>
            </div>
            <div class="mb-3">
                <div class="text-muted">Video Name:</div>
                <?php echo $model->video_name ?>
            </div>

            <?=$form->field($model, 'status')->dropDownList($model->getStatusLabels())?>
        </div>
    </div>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>