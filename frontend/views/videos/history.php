<?php

use yii\widgets\ListView;

$this->title = 'iTube - History for your videos';

?>
<h1 class="m-4">My History</h1>
<hr class="m-4">
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]);
