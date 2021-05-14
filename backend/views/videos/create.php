<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Videos */

$this->title = 'Create Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create">

    <h1><?=Html::encode($this->title)?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        <br>
        <p class="m-0">Kéo và thả tệp video để tải lên</p>
        <p class="text-muted">Các video của bạn sẽ ở chế độ riêng tư cho đến khi bạn xuất bản.</p>

        <?php \yii\bootstrap4\ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
])?>

        <button class="btn btn-primary btn-file">
            Select File
            <input type="file" id="videoFile" name="video">
        </button>

        <?php \yii\bootstrap4\ActiveForm::end()?>

    </div>

</div>