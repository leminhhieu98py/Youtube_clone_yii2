<?php

use common\models\User;
use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$currentRoute = '/' . $controller . '/' . $action;
$user = User::find()
    ->andWhere(['id' => Yii::$app->user->identity->id])
    ->one();
?>
<aside>
    <div class="d-flex flex-column nav-pills">
        <div data-route="<?= $currentRoute ?>" class="aside-user-profile-wrapper">
            <div class="text-center m-3">
                <img src="<?= $user->getAvatarLink() ?>" alt="avatar">
            </div>
            <div class="text-center">
                <div class="font-weight-bold">Your Channel</div>
                <p class="text-muted"><?= Yii::$app->user->identity->username ?></p>
            </div>
        </div>
        <a href="<?= Url::to('/site/index') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper text-center p-0 col-2"><i class="fas fa-chart-bar"></i></div>
            <div class="aside-nav-link">Dashboard</div>
        </a>
        <a href="<?= Url::to('/videos/index') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-photo-video"></i></div>
            <div class="aside-nav-link">Content</div>
        </a>
        <a href="<?= Url::to('/videos/create') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-folder-plus"></i></i></div>
            <div class="aside-nav-link">Upload</div>
        </a>
    </div>
</aside>