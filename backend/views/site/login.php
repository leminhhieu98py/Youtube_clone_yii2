<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'studio.iTube - Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex justify-content-center">
    <div class="site-login">
        <div class="login-image-wrapper">
            <figure>
                <img src="https://thichtrongcay.com.vn/assets/img/login.png" alt="">
            </figure>
        </div>
        <div class="login-form">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
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

            <p style="font-size:14px;color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                <br>
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
            </p>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn-submit', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="d-flex">
            <a href=" <?= Url::to('signup') ?>" class="login-image-link">Create an account</a>
            <div class="social-login">
                <span class="social-label">Or login with</span>
                <ul class="socials">
                    <li>
                        <a href="">
                            <i class="display-flex-center zmdi zmdi-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="display-flex-center zmdi zmdi-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="display-flex-center zmdi zmdi-google"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>