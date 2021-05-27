<?php

use aryelds\sweetalert\SweetAlert;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider --> Videos */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">
    <h1 class="m-4"><?= Html::encode($this->title) ?></h1>
    <hr class="mb-5">
    <a class="m-4" href="<?= Url::to('create') ?>">
        <button class="btn create-video-btn" data-toggle="modal" data-target="#exampleModal">Create Video</button>
    </a>


    <?= GridView::widget([
        'options' => [
            'class' => 'm-4 videos-management animate__animated animate__bounceInUp'
        ],
        'dataProvider' => $dataProvider,
        'formatter' => [
            'class' => \yii\i18n\Formatter::class,
            'timeZone' => 'Asia/Ho_Chi_Minh',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'content' => function ($model) {
                    return $this->render(
                        '_video_item',
                        [
                            'model' => $model,
                        ]
                    );
                }
            ],
            [
                'attribute' => 'status',
                'content' => function ($model) {
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a('<i class="fas fa-trash delete-video-btn"></i>', $url, [
                            'data-confirm' => "Are you sure?",
                            'data-method' => 'post',
                            'class' => 'delete-video',
                            'data-url' => $url
                        ]);
                    },
                    'update' => function ($url) {
                        return Html::a('', $url);
                    },
                    'view' => function ($url) {
                        return Html::a('', $url);
                    },
                ]
            ],
        ],
    ]); ?>


</div>