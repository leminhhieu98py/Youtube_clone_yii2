<?php

use yii\helpers\Url;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$currentRoute = '/' . $controller . '/' . $action;
?>

<aside>
    <div data-route="<?= $currentRoute ?>" class="sidebar-itube d-flex flex-column nav-pills">
        <a href="<?= Url::to('/videos/index') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper text-center p-0 col-2"><i class="fas fa-home"></i></div>
            <div class="aside-nav-link">Home</div>
        </a>
        <a href="<?= Url::to('/videos/history') ?>" class="nav-link text-dark d-flex align-items-center" style="text-decoration: none;">
            <div class="aside-nav-link aside-icon-wrapper p-0 text-center col-2"><i class="fas fa-history"></i></div>
            <div class="aside-nav-link">History</div>
        </a>
    </div>
</aside>

<!-- <aside class="shadow">

    echo \yii\bootstrap4\Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills',
        ],
        'items' => [
            [
                'label' => 'Home',
                'url' => ['/videos/index'],
            ],
            [
                'label' => 'History',
                'url' => ['/videos/history'],
            ],
        ],
    ])
    ?>
</aside> -->