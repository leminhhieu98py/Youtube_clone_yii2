<?php

/** @var $channel \common\models\User */
/** @var $dataProvider ActiveDataProvider */

use common\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = "iTube - $channel->username's Channel";

?>
<div class="channel-wrapper">
    <div class="channel-banner"></div>
    <div class="d-flex w-100 align-items-center channel-info-wrapper">
        <div class="channel-img-wrapper d-flex justify-content-center col-1 p-0">
            <img src="<?= $channel->getAvatarLink() ?>" alt="avatar">
        </div>
        <div class="col-2 d-flex flex-column justify-content-center">
            <div class="channel-creator-name">
                <?php echo Html::channelLink($channel) ?>
            </div>
            <p class="text-muted m-0 channel-subscriber-count"><?= $channel->getSubscribes()->count() ?> <?= ($channel->getSubscribes()->count() > 1) ? 'subscribers' : 'subscriber' ?></p>
        </div>
        <hr class="my-4">
        <?php Pjax::begin() ?>
        <?php echo $this->render('_subscribe', [
            'channel' => $channel,
        ]) ?>
        <?php Pjax::end() ?>
    </div>

    <!-- CHANNEL NAV BAR -->
    <div class="d-flex w-100 shadow align-items-center channel-nav-bar">
        <ul class="d-flex">
            <li>
                <a href="<?= Url::to([
                                '/channel/view',
                                'username' => $channel->username,
                                'page' => 'home'
                            ]) ?>" style="text-decoration: none;">
                    <div class="channel-nav-title <?= ($page == "home") ? "active" : '' ?>">HOME</div>
                </a>
                <div class="channel-nav-pad animate__animated animate__backInLeft <?= ($page == "home") ? "active" : '' ?>"></div>
            </li>
            <li>
                <a href="<?= Url::to([
                                '/channel/view',
                                'username' => $channel->username,
                                'page' => 'videos'
                            ]) ?>" style="text-decoration: none;">
                    <div class="channel-nav-title <?= ($page == "videos") ? "active" : '' ?>">VIDEOS</div>
                </a>
                <div class="channel-nav-pad animate__animated animate__backInLeft <?= ($page == "videos") ? "active" : '' ?>"></div>
            </li>
            <li>
                <a href="<?= Url::to([
                                '/channel/view',
                                'username' => $channel->username,
                                'page' => 'playlists'
                            ]) ?>" style="text-decoration: none;">
                    <div class="channel-nav-title <?= ($page == "playlists") ? "active" : '' ?>">PLAYLISTS</div>
                </a>
                <div class="channel-nav-pad animate__animated animate__backInLeft <?= ($page == "playlists") ? "active" : '' ?>"></div>
            </li>
            <li>
                <a href="<?= Url::to([
                                '/channel/view',
                                'username' => $channel->username,
                                'page' => 'community'
                            ]) ?>" style="text-decoration: none;">
                    <div class="channel-nav-title <?= ($page == "community") ? "active" : '' ?>">COMMUNITY</div>
                </a>
                <div class="channel-nav-pad animate__animated animate__backInLeft <?= ($page == "community") ? "active" : '' ?>"></div>
            </li>
            <li>
                <a href="<?= Url::to([
                                '/channel/view',
                                'username' => $channel->username,
                                'page' => 'channels'
                            ]) ?>" style="text-decoration: none;">
                    <div class="channel-nav-title <?= ($page == "channels") ? "active" : '' ?>">CHANNELS</div>
                </a>
                <div class="channel-nav-pad animate__animated animate__backInLeft <?= ($page == "channels") ? "active" : '' ?>"></div>
            </li>
            <li>
                <a href="<?= Url::to([
                                '/channel/view',
                                'username' => $channel->username,
                                'page' => 'about'
                            ]) ?>" style="text-decoration: none;">
                    <div class="channel-nav-title <?= ($page == "about") ? "active" : '' ?>">ABOUT</div>
                </a>
                <div class="channel-nav-pad animate__animated animate__backInLeft <?= ($page == "about") ? "active" : '' ?>"></div>
            </li>
            <li>
                <div class="channel-nav-title"><i class="fas fa-search"></i></div>
                <div class="channel-nav-pad"></div>
            </li>
        </ul>
    </div>

    <div class="channel-videos-wrapper" data-page="<?= $page ?>" style="background-color: #F1F1F1;">
        <?php
        if ($page == "home") {
            if (count($videos) > 0) {
                $videos_most_popular_array = [];
                foreach ($videos as $video) {
                    $video_view = $video->getViews()->count();
                    if (array_key_exists($video_view, $videos_most_popular_array)) {
                        $duplicate = true;
                        while ($duplicate) { //reduce the key until it doesn't exist in the array
                            $video_view--;
                            $duplicate = false;
                            if (array_key_exists($video_view, $videos_most_popular_array)) {
                                $duplicate = true;
                            }
                        }
                    }
                    $videos_most_popular_array[$video_view] = $video;
                }
                krsort($videos_most_popular_array); //return the array sorting by key (video_view)
                $most_popular_video = $videos_most_popular_array[array_key_first($videos_most_popular_array)];

        ?>
                <div class="channel-home-wrapper">
                    <!--  display most popular video -->
                    <div class="row m-0">
                        <div class="p-0 col-5 col-lg-5 col-md-6 col-sm-12 embed-responsive embed-responsive-16by9">
                            <video class="embed-responsive-item" poster="<?= $most_popular_video->getThumbnailLink() ?>" src="<?= $most_popular_video->getVideoLink() ?>" autoplay controls></video>
                        </div>
                        <div class="col-5 col-lg-5 col-md-5 col-sm-12 pl-4 pr-4" style="max-height: 270px; overflow-y: hidden;">
                            <div class="row flex-column p-0 m-0">
                                <h6 class="card-title m-0"><?= StringHelper::truncateWords($most_popular_video->title, 10) ?></h6>
                                <p class="text-muted mt-3 mb-3"><?= $most_popular_video->getViews()->count() ?> views <?= Yii::$app->formatter->asRelativeTime($most_popular_video->created_at) ?></p>
                                <p><?= $most_popular_video->description ?></p>
                            </div>
                        </div>
                        <div class="col-2 col-md-0 col-sm-0"></div>
                    </div>
                    <div class="shadow mt-4 mb-4" style="height: 1px; border-bottom: 1px solid #D4D4D4;"></div> <!-- instead of hr tag -->

                    <!-- Popular uploads trend -->
                    <div>
                        <!-- Title video trend -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="video-trend-title">
                                Popular Uploads
                            </div>
                            <div class="play-all-btn">
                                <i class="fas fa-play mr-3"></i>
                                PLAY ALL
                            </div>
                        </div>

                        <!-- Popular Videos -->
                        <div class="w-100" style="overflow: hidden;">
                            <div class="videos-slide-wrapper popular-videos" data-videos-count="<?= (count($videos_most_popular_array) <= 10) ? count($videos_most_popular_array) : 10 ?>">
                                <?php
                                $count = 0;
                                foreach ($videos_most_popular_array as $video) {
                                    if ($count < 10) {
                                        $count++;
                                ?>
                                        <div class="video-card-channel">
                                            <a href="<?= Url::to(['/videos/view', 'id' => $video->video_id]) ?>">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <video class="embed-responsive-item" poster="<?= $video->getThumbnailLink() ?>" src="<?= $video->getVideoLink() ?>"></video>
                                                </div>
                                            </a>
                                            <div class="p-2 row m-0">
                                                <h6 class="card-title m-0"><?= StringHelper::truncateWords($video->title, 10) ?></h6>
                                                <p class="text-muted card-text m-0"><?= $video->getViews()->count() ?> views <?= Yii::$app->formatter->asRelativeTime($video->created_at) ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div><i class="fas fa-angle-left previous-videos-channel-btn popular-video-previous-btn"></i></div>
                            <div><i class="fas fa-angle-right next-videos-channel-btn popular-video-next-btn"></i></div>
                        </div>
                        <div class="shadow mb-4" style="height: 1px; border-bottom: 1px solid #D4D4D4;"></div> <!-- instead of hr tag -->

                        <!-- Title video trend -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="video-trend-title">
                                Latest Uploads
                            </div>
                            <div class="play-all-btn">
                                <i class="fas fa-play mr-3"></i>
                                PLAY ALL
                            </div>
                        </div>

                        <!-- Latest Uploads -->
                        <div class="w-100" style="overflow: hidden;">
                            <div class="videos-slide-wrapper latest-videos" data-videos-count="<?= count($videos) ?>">
                                <?php
                                $count = 0;
                                foreach ($videos as $video) {
                                    $count++;
                                ?>
                                    <div class="video-card-channel">
                                        <a href="<?= Url::to(['/videos/view', 'id' => $video->video_id]) ?>">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <video class="embed-responsive-item" poster="<?= $video->getThumbnailLink() ?>" src="<?= $video->getVideoLink() ?>"></video>
                                            </div>
                                        </a>
                                        <div class="p-2 row m-0">
                                            <h6 class="card-title m-0"><?= StringHelper::truncateWords($video->title, 10) ?></h6>
                                            <p class="text-muted card-text m-0"><?= $video->getViews()->count() ?> views <?= Yii::$app->formatter->asRelativeTime($video->created_at) ?></p>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div><i class="fas fa-angle-left previous-videos-channel-btn latest-video-previous-btn"></i></div>
                            <div><i class="fas fa-angle-right next-videos-channel-btn latest-video-next-btn"></i></div>
                        </div>
                        <div class="shadow mb-4" style="height: 1px; border-bottom: 1px solid #D4D4D4;"></div> <!-- instead of hr tag -->
                    </div>
                </div>
            <?php
            } else {
            ?>
                <!-- when channel home have nothing -->
                <div>
                    <div class="text-center mb-5">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/storage/banner/not_found.png" alt="" style="height: 200px; overflow-x:hidden; margin-top: 100px;">
                    </div>
                    <h2 class="text-center">Upload a video to get started</h2>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 text-center text-muted">
                            <p style="font-size: 17px;">Start sharing your story and connecting with viewers. Videos you upload will show up here.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mt-3 mb-3">UPLOAD VIDEO</button>
                        <small class="text-muted d-block" style="padding-bottom: 80px;">Learn more about <a href="">how to get started</a></small>
                    </div>
                </div>
            <?php
            }
        } else if ($page == "videos") {
            if (count($videos) > 0) {
            ?>
                <div class="d-flex flex-wrap">
                    <?php
                    foreach ($videos as $video) {
                    ?>
                        <div class="card video-card-channel border-0 mb-1 animate__fadeInUp animate__animated">
                            <a href="<?= Url::to(['/videos/view', 'id' => $video->video_id]) ?>">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video class="embed-responsive-item" poster="<?= $video->getThumbnailLink() ?>" src="<?= $video->getVideoLink() ?>"></video>
                                </div>
                            </a>
                            <div class="card-body p-2 row m-0">
                                <div class="_video_item_img_wrapper col-2 p-0">
                                    <img src="<?= $video->createdBy->getAvatarLink() ?>" alt="avatar">
                                </div>
                                <div class="col-10 p-0">
                                    <h6 class="card-title m-0"><?= StringHelper::truncateWords($video->title, 10) ?></h6>
                                    <span data-container="body" data-toggle="tooltip" data-placement="top" title="<?= Html::channelName($video->createdBy) ?>"><?php echo Html::channelLink($video->createdBy) ?></span>
                                    <p class="text-muted card-text m-0"><?= $video->getViews()->count() ?> views <?= Yii::$app->formatter->asRelativeTime($video->created_at) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <!-- when channel videos have nothing -->
                <div>
                    <div class="text-center mb-5">
                        <img src="<?php echo Yii::$app->request->baseUrl; ?>/storage/banner/not_found.png" alt="" style="height: 200px; overflow-x:hidden; margin-top: 100px;">
                    </div>
                    <h2 class="text-center">Upload a video to get started</h2>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 text-center text-muted">
                            <p style="font-size: 17px;">Start sharing your story and connecting with viewers. Videos you upload will show up here.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mt-3 mb-3">UPLOAD VIDEO</button>
                        <small class="text-muted d-block" style="padding-bottom: 80px;">Learn more about <a href="">how to get started</a></small>
                    </div>
                </div>
            <?php
            }
        } else if ($page == "playlists") {
            ?>
            <div>
                <div class="text-center mb-5">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/storage/banner/play_list.png" alt="" style="height: 200px; overflow-x:hidden; margin-top: 100px;">
                </div>
                <h2 class="text-center">Create a playlist to store videos categories</h2>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 text-center text-muted">
                        <p style="font-size: 17px;">Start sharing your story and connecting with viewers. Videos you upload will show up here and be gatherred in playlists.</p>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary mt-3 mb-3">CREATE PLAYLIST</button>
                    <small class="text-muted d-block" style="padding-bottom: 80px;">Learn more about <a href="">how to get started</a></small>
                </div>
            </div>
        <?php
        } else if ($page == "community") {
        ?>
            <div>
                <div class="text-center mb-4">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/storage/banner/community.png" alt="" style="height: 200px; overflow-x:hidden; margin-top: 100px;">
                </div>
                <h2 class="text-center">If you want to go quickly, go alone</h2>
                <h2 class="text-center">If you want to go far, go together</h2>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 text-center text-muted">
                        <p style="font-size: 17px;">Start connecting to other youtubers and building your communities. You can also share your photos, statuses and your stories here ^^</p>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary mt-3 mb-3">CREATE POST</button>
                    <small class="text-muted d-block" style="padding-bottom: 80px;">Learn more about <a href="">how to get started</a></small>
                </div>
            </div>
        <?php
        } else if ($page == "channels") {
            // echo ListView::widget([
            //     'dataProvider' => $dataProvider,
            //     'itemView' => '../videos/_video_item',
            //     'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
            //     'itemOptions' => [
            //         'tag' => false,
            //     ]
            // ]);
        } else if ($page == "about") {
            // echo ListView::widget([
            //     'dataProvider' => $dataProvider,
            //     'itemView' => '../videos/_video_item',
            //     'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
            //     'itemOptions' => [
            //         'tag' => false,
            //     ]
            // ]);
        }
        ?>
    </div>

</div>