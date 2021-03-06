<?php

use common\helpers\Html;
use common\models\User;
use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$currentRoute = '/' . $controller . '/' . $action;
?>

<div class="header-site shadow-sm d-flex flex-wrap">
    <!-- Left -->
    <div class="d-flex col-lg-2 col-md-4 col-sm-4">
        <div class="menu-icon-wrapper"><i class="fas fa-bars" style="font-size:20px; color: rgb(116,116,116);"></i></div>
        <div class="d-flex align-items-center youtube-studio-icon-wrapper"><a href="<?= Yii::$app->homeUrl ?>"><img class="youtube-studio-icon" src="https://www.gstatic.com/youtube/img/creator/yt_studio_logo.svg" alt="youtube-icon"></a></div>
    </div>
    <div class="col-1"></div>

    <!-- Middle -->
    <div class="col-lg-6 col-md-7 col-sm-7 search-bar-wrapper">
        <form action="<?php echo Url::to(['/videos/search']) ?>" class="form-inline">
            <input class="form-control mr-sm-2 input-search-bar" type="search" placeholder="Search..." name="keyword" value="<?= Yii::$app->request->get('keyword') ?>">
            <button class="btn studio-search-btn my-2 my-sm-0">Search</button>
        </form>
    </div>

    <!-- Right -->
    <div class="d-flex justify-content-end col-lg-3 col-md-12 profile-icon-wrapper">
        <div class="help-wrapper">
            <i class="far fa-question-circle help"></i>
        </div>

        <?php
        if (Yii::$app->user->isGuest) {
        ?>
            <a href="<?= Url::to(['/site/login']) ?>" data-method="post" class="d-flex align-items-center text-dark mr-2" style="text-decoration: none;">
                <div class="logout-wrapper d-flex align-items-center">
                    <div class="logout">LOGIN</div>
                    <i class="fas fa-sign-in-alt"></i>
                </div>
            </a>
            <a href="<?= Url::to(['/site/signup']) ?>" data-method="post" class="d-flex align-items-center text-dark" style="text-decoration: none;">
                <div class="logout-wrapper d-flex align-items-center">
                    <div class="logout">SIGN UP</div>
                    <i class="fas fa-user-plus"></i>
                </div>
            </a>
        <?php
        } else {
            $user = User::find()
                ->andWhere(['id' => Yii::$app->user->identity->id])
                ->one();
        ?>


            <div class="btn-group">
                <div class="d-flex header-user-wrapper mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="mr-2" src="<?= $user->getAvatarLink() ?>" alt="avatar">
                    <?php echo Html::channelLink($user) ?>
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="header-user__title" href="<?= Url::to(['/channel/view', 'username' => $user->username, 'page' => 'home']) ?>" style="text-decoration: none;"><button class="dropdown-item" type="button">My channel</button></a>
                    <!-- <a href="" style="text-decoration: none;"><button class="dropdown-item" type="button">My iTube Studio</button></a> -->

                    <a class="header-user__title" href="<?= Url::to(['/site/logout']) ?>" data-method="post" class="d-flex justify-content-between align-items-center text-dark dropdown-item" style="text-decoration: none;">
                        <button class="dropdown-item" type="button">Log out<i class="ml-2 fas fa-sign-out-alt" style="font-size: 16px;"></i></button>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
