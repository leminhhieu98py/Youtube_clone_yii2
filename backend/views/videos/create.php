<?php

use backend\assets\VideosAsset;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Videos */

$this->title = 'Upload Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
VideosAsset::register($this);
?>

<div class="videos-create m-4">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        <br>
        <p class="m-0">Drag and drop video files to upload</p>
        <p class="text-muted">Your videos will be private until you publish them.</p>
        <?php $form = \yii\bootstrap4\ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'text-center mb-5'
            ],
        ]) ?>
        <button class="btn btn-primary btn-file">
            SELECT FILE
            <input type="file" id="videoFile" name="video">
        </button>
        <p><?= $form->errorSummary($model) ?></p>

        <?php \yii\bootstrap4\ActiveForm::end() ?>
        <div class="copyright text-center" style="margin-top: 15vh;">
            <small class="d-block text-muted mb-0">By submitting your videos to YouTube, you acknowledge that you agree to iTube's <a href="">Terms of Service</a> and <a href="">Community Guidelines</a>.</small>
            <small class="d-block text-muted">Please be sure not to violate others' copyright or privacy rights. <a href="">Learn more</a>.</small>
        </div>
    </div>

</div>