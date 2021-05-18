<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
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
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure?'
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