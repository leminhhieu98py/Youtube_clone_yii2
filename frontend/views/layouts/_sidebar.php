<aside class="shadow">
    <?php
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
</aside>