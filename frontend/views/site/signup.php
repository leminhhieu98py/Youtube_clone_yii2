<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'iTube - Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex justify-content-center">
    <div class="site-signup">
        <div class="signup-form">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <h1 class="form-title"><?= Html::encode($this->title) ?></h1>

            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'placeholder' => 'Your username...',
                ],
            ])->label('<i class="fas fa-user"></i>')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'placeholder' => 'Your password...',
                ],
            ])->passwordInput()->label('<i class="fas fa-unlock-alt"></i>') ?>

            <?= $form->field($model, 'email', [
                'inputOptions' => [
                    'placeholder' => 'Your email...',
                ],
            ])->label('<i class="fas fa-envelope"></i>') ?>

            <?= $form->field($model, 'avatar')->fileInput([
                'class' => "avatar-input",
            ])->label('<i class="fas fa-camera"></i>') ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn-submit', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="signup-image-wrapper">
            <figure>
                <img src="https://system.trakaffdemo.in/sign_up2_assets/images/signup-image.jpg" alt="">
            </figure>
            <a href=" <?= Url::to('login') ?>" class="signup-image-link">I am already member</a>
        </div>
    </div>
</div>