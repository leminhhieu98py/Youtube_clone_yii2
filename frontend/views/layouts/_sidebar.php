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
    <div data-route="<?= $currentRoute ?>" class="sidebar-itube d-flex flex-column nav-pills">
        <a href="<?= Url::to('/videos/index') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper text-center p-0 col-2"><i class="fas fa-home"></i></div>
            <div class="aside-nav-link">Home</div>
        </a>
        <a href="<?= (isset($user)) ? Url::to(['/channel/view', 'username' => $user->username, 'page' => "home"]) : Url::to('/site/login') ?>" class="nav-link text-dark d-flex align-items-center channel-side-bar" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper text-center p-0 col-2"><i class="fas fa-bookmark"></i></div>
            <div class="aside-nav-link">Channel</div>
        </a>
        <a href="<?= Url::to('/videos/history') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-history"></i></div>
            <div class="aside-nav-link">History</div>
        </a>
        <div style="border-top: 1px solid rgb(229, 229, 229); margin: 0 10px;"></div>
        <a href="<?= Url::to('/videos/library') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-book"></i></div>
            <div class="aside-nav-link">Library</div>
        </a>
        <a href="<?= Url::to('/videos/watchlatervideos') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-clock"></i></div>
            <div class="aside-nav-link">Watch Later</div>
        </a>
        <a href="<?= Url::to('/videos/likedvideos') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-thumbs-up"></i></div>
            <div class="aside-nav-link">Liked Videos</div>
        </a>
        <a href="" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-chevron-down"></i></div>
            <div class="aside-nav-link">Show more</div>
        </a>
    </div>
</aside>