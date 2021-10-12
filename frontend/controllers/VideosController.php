<?php

namespace frontend\controllers;

use common\models\VideoComment;
use common\models\VideoLike;
use common\models\Videos;
use common\models\VideoView;
use common\models\VideoWatchLater;
use common\models\User;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class VideosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike', 'history', 'checkcomment', 'comment', 'library'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }
    public function actionIndex()
    {
        $dataProvider = Videos::find()
            ->published()
            ->latest()
            ->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $params = yii::$app->request->get();
        $id = $params['id'];
        $video = $this->findVideo($id);
        $videoComments = VideoComment::find()
            ->videoID($id)
            ->all();
        $this->layout = 'view';
        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        $similarVideos = Videos::find()
            ->published()
            ->byKeyword($video->title)
            ->andWhere(['NOT', ['video_id' => $id]])
            ->limit(10)
            ->all();

        return $this->render('view', [
            'model' => $video,
            'similarVideos' => $similarVideos,
            'comments' => $videoComments,
        ]);
    }

    public function actionLike()
    {
        $params = yii::$app->request->get();
        $id = $params['id'];
        $video = $this->findVideo($id);
        $userID = Yii::$app->user->id;
        $videoLikeDislike = VideoLike::find()
            ->userIDvideoID($userID, $id)
            ->one();
        if (!$videoLikeDislike) {
            $this->saveLikeDislike($id, $userID, VideoLike::TYPE_LIKE);
        } elseif ($videoLikeDislike->type === VideoLike::TYPE_LIKE) {
            $videoLikeDislike->delete();
        } else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $userID, VideoLike::TYPE_LIKE);
        }
        return $this->renderPartial('_buttons', [
            'model' => $video,
        ]);
    }

    public function actionDislike()
    {
        $params = yii::$app->request->get();
        $id = $params['id'];
        $video = $this->findVideo($id);
        $userID = Yii::$app->user->id;
        $videoLikeDislike = VideoLike::find()
            ->userIDvideoID($userID, $id)
            ->one();
        if (!$videoLikeDislike) {
            $this->saveLikeDislike($id, $userID, VideoLike::TYPE_DISLIKE);
        } elseif ($videoLikeDislike->type === VideoLike::TYPE_DISLIKE) {
            $videoLikeDislike->delete();
        } else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $userID, VideoLike::TYPE_DISLIKE);
        }
        return $this->renderPartial('_buttons', [
            'model' => $video,
        ]);
    }

    protected function findVideo($id)
    {
        $video = Videos::findOne($id);
        if (!$video) {
            throw new NotFoundHttpException("Video does not exist anymore!");
        }
        return $video;
    }

    protected function saveLikeDislike($videoID, $userID, $type)
    {
        $videoLikeDislike = new VideoLike();
        $videoLikeDislike->video_id = $videoID;
        $videoLikeDislike->user_id = $userID;
        $videoLikeDislike->created_at = time();
        $videoLikeDislike->type = $type;
        $videoLikeDislike->save();
    }

    protected function saveWatchLater($videoID, $userID, $type)
    {
        $videoWatchLater = new VideoWatchLater();
        $videoWatchLater->video_id = $videoID;
        $videoWatchLater->user_id = $userID;
        $videoWatchLater->created_at = time();
        $videoWatchLater->type = $type;
        $videoWatchLater->save();
    }

    public function actionSearch()
    {
        $params = Yii::$app->request->get();
        $keyword = $params['keyword'];
        $query = Videos::find()
            ->published()
            ->latest();
        if ($keyword != "") {
            $query->byKeyword($keyword)
                ->orderBy(
                    "MATCH(title, tags, description) AGAINST (:keyword) DESC",
                    ['keyword' => $keyword]
                );
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHistory()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()
                ->alias('v')
                ->innerJoin(
                    "(SELECT video_id, MAX(created_at) as max_date 
                    FROM video_view
                    WHERE user_id = (:user_id)
                    GROUP BY video_id) vv",
                    'vv.video_id = v.video_id',
                    ['user_id' => Yii::$app->user->id],
                )
                ->orderBy('vv.max_date DESC'),
        ]);

        return $this->render('history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLibrary()
    {
        $historyVideos = new ActiveDataProvider([
            'query' => Videos::find()
                ->alias('v')
                ->innerJoin(
                    "(SELECT video_id, MAX(created_at) as max_date 
                    FROM video_view
                    WHERE user_id = (:user_id)
                    GROUP BY video_id) vv",
                    'vv.video_id = v.video_id',
                    ['user_id' => Yii::$app->user->id],
                )
                ->orderBy('vv.max_date DESC')
                ->limit(4),
            'pagination' => false,
        ]);

        $watchLaterVideos = new ActiveDataProvider([
            'query' => Videos::find()
                ->alias('v')
                ->innerJoin(
                    "(SELECT video_id, MAX(created_at) as max_date 
                    FROM video_watch_later
                    WHERE user_id = (:user_id)
                    AND type = 1
                    GROUP BY video_id) vwl",
                    'vwl.video_id = v.video_id',
                    ['user_id' => Yii::$app->user->id],
                )
                ->orderBy('vwl.max_date DESC')
                ->limit(4),
            'pagination' => false,
        ]);

        $likedVideos = new ActiveDataProvider([
            'query' => Videos::find()
                ->alias('v')
                ->innerJoin(
                    "(SELECT video_id, MAX(created_at) as max_date 
                    FROM video_like
                    WHERE user_id = (:user_id)
                    AND type = 1
                    GROUP BY video_id) vl",
                    'vl.video_id = v.video_id',
                    ['user_id' => Yii::$app->user->id],
                )
                ->orderBy('vl.max_date DESC')
                ->limit(4),
                'pagination' => false,
        ]);

        // count subsrcibers
        $params = Yii::$app->request->get();
        $username = $params['username'];
        $channel = $this->findChannel($username);

        // count videos
        $videos = Videos::find()
        ->creator($channel->id)
        ->published()
        ->latest()
        ->all();

        // count total likes
        $user = Yii::$app->user->identity;
        $userID = $user->id;
        $totalLikes = VideoLike::find()
        ->liked()
        ->alias('vl')
        ->innerJoin(Videos::tableName() . 'v', 'v.video_id = vl.video_id')
        ->andWhere(['v.created_by' => $userID])
        ->count();

        return $this->render('library', [
            'historyVideos' => $historyVideos,
            'watchLaterVideos' => $watchLaterVideos,
            'likedVideos' => $likedVideos,
            'channel' => $channel,
            'videos' => $videos,
            'totalLikes' => $totalLikes,
        ]);
    }

    protected function findChannel($username)
    {
        $channel = User::findByUsername($username);
        if (!$channel) {
            throw new NotFoundHttpException("This channel does not exist anymore!");
        }
        return $channel;
    }

    public function actionLikedvideos()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()
                ->alias('v')
                ->innerJoin(
                    "(SELECT video_id, MAX(created_at) as max_date 
                    FROM video_like
                    WHERE user_id = (:user_id)
                    AND type = 1
                    GROUP BY video_id) vl",
                    'vl.video_id = v.video_id',
                    ['user_id' => Yii::$app->user->id],
                )
                ->orderBy('vl.max_date DESC'),
        ]);

        return $this->render('likedVideos', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWatchlater()
    {
        $params = yii::$app->request->get();
        $id = $params['id'];
        $video = $this->findVideo($id);
        $userID = Yii::$app->user->id;
        $videoWatchLater = VideoWatchLater::find()
            ->userIDvideoID($userID, $id)
            ->one();
        if (!$videoWatchLater) {
            $this->saveWatchLater($id, $userID, VideoWatchLater::TYPE_WATCH_LATER);
        } elseif ($videoWatchLater->type === VideoWatchLater::TYPE_WATCH_LATER) {
            $videoWatchLater->delete();
        }
        return $this->renderPartial('_buttons', [
            'model' => $video,
        ]);
    }

    public function actionWatchlatervideos()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()
                ->alias('v')
                ->innerJoin(
                    "(SELECT video_id, MAX(created_at) as max_date 
                    FROM video_watch_later
                    WHERE user_id = (:user_id)
                    AND type = 1
                    GROUP BY video_id) vwl",
                    'vwl.video_id = v.video_id',
                    ['user_id' => Yii::$app->user->id],
                )
                ->orderBy('vwl.max_date DESC'),
        ]);

        return $this->render('likedVideos', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCheckcomment()
    {
    }
    public function actionComment()
    {
        $params = yii::$app->request->post();
        $id = $params['videoID'];
        $video = $this->findVideo($id);
        $content = $params['content'];
        $userID = Yii::$app->user->id;
        $this->saveComment($id, $userID, $content);
        return $this->renderPartial('_comment_input', [
            'model' => $video
        ]);
    }

    public function actionDisplaycomments()
    {
        $params = yii::$app->request->post();
        $id = $params['videoID'];
        $video = $this->findVideo($id);
        $videoComments = VideoComment::find()
            ->videoID($id)
            ->latest()
            ->all();
        return $this->renderPartial('_comments', [
            'comments' => $videoComments,
            'model' => $video,
        ]);
    }

    protected function saveComment($videoID, $userID, $content)
    {
        $videoComment = new VideoComment();
        $videoComment->video_id = $videoID;
        $videoComment->user_id = $userID;
        $videoComment->created_at = time();
        $videoComment->content = $content;
        $videoComment->save();
    }
}
