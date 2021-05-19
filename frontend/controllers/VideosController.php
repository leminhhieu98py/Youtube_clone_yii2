<?php

namespace frontend\controllers;

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
                'only' => ['like', 'dislike'],
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
                    'dislike' => ['post']
                ]
            ]
        ];
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Videos::find()->published()->latest(),
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
        $this->layout = 'authentication';
        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();
        return $this->render('view', [
            'model' => $video
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
}
