<?php

use yii\helpers\StringHelper;
use yii\helpers\Url;
use backend\assets\PostsAsset;

$this->title = 'Posts Management';
$this->params['breadcrumbs'][] = $this->title;
PostsAsset::register($this);
?>


<div class="posts-index">
    <h1 class="m-4">Posts Management</h1>
    <hr class="mb-5">
    <a class="m-4" href="<?= Url::to('create') ?>">
        <button class="btn create-video-btn" data-toggle="modal" data-target="#exampleModal">New post</button>
    </a>
    <div class="w-100" style="padding: 0 24px;">
        <table class="table table-bordered mt-4 videos-management animate__animated animate__bounceInUp">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 8%; text-align: center;">#</th>
                    <th style="text-align: center;">Post</th>
                    <th style="width: 10%; text-align: center;">Status</th>
                    <th style="width: 20%; text-align: center;">Created at</th>
                    <th style="width: 8%; text-align: center;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($posts) > 0) {
                    foreach ($posts as $key => $post) {
                ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            <td class="d-flex">
                            <?php /* Url::base(true) . 'link image here' */ ?>
                                <a href="<?= Url::to(['posts/update', 'id' => $post['post_id']]) ?>">
                                    <img class="mr-3" src="https://scontent.fsgn2-2.fna.fbcdn.net/v/t1.6435-9/p526x296/218102045_10219890203434448_3264393914388087981_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=8bfeb9&_nc_ohc=SftwywphHwIAX_y5Ffq&_nc_oc=AQlCoqmiGE3bm-3PgNgGtCIxXjFrkCTnCzPeq4REY7NAp50762VkNM-SGPXT16lUEC0&_nc_ht=scontent.fsgn2-2.fna&oh=510f83b498b16b758331f2bbc1a36202&oe=619CAF7B"  alt="" style="width: 140px; max-height: 100px; overflow: hidden;">
                                </a>
                                <div class="media-body">
                                    <?php echo StringHelper::truncateWords($post['post_description'], 40) ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <?= $post['post_status'] ?>
                            </td>
                            <td class="text-center">
                                <?= $post['created_at'] ?>
                            </td>
                            <td class="text-center">
                                <i class="fas fa-trash"></i>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td class="text-center" colspan="5">No results found.</td>
                        <?php
                        echo date("Y-m-d H:i:s", 1622171535);
                        date_default_timezone_set("Asia/Ho_Chi_Minh");
                        echo date("Y-m-d H:i:s");
                        // echo date($post['post_status']);
                        ?>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>