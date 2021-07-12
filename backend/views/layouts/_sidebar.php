<?php

use common\models\User;
use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$currentRoute = '/' . $controller . '/' . $action;
if (isset(Yii::$app->user->identity->id)) {
    $user = User::find()
        ->andWhere(['id' => Yii::$app->user->identity->id])
        ->one();
}

?>
<aside class="main-side-bar">
    <div class="d-flex flex-column nav-pills">
        <div data-route="<?= $currentRoute ?>" class="aside-user-profile-wrapper">
            <div class="text-center m-3">
                <img src="<?php
                            if (isset($user)) {
                                echo $user->getAvatarLink();
                            } else {
                                echo "https://lh3.googleusercontent.com/proxy/nO0hrtMIkXkvSRHr8AUcHtXYaz1iCuwGRtO__amTtwwVmouJsCcvvyqGlgR38uBoi5v8kxJnZj0N41O461nBVch1e7lczD4";
                            }  ?>" alt="avatar">
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