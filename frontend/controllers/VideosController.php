<?php

namespace frontend\controllers;

use common\models\VideoComment;
use common\models\VideoLike;
use common\models\Videos;
use common\models\VideoView;
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
                'only' => ['like', 'dislike', 'history', 'checkcomment', 'comment'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()->with('createdBy')->published()->latest(),
        ]);

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
