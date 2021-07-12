<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Subscriber;
use common\models\User;
use common\models\VideoComment;
use common\models\VideoLike;
use common\models\Videos;
use common\models\VideoView;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $userID = $user->id;
        $lastestVideo = Videos::find()
            ->creator($userID)
            ->published()
            ->latest()
            ->limit(1)
            ->one();

        $numberOfView = VideoView::find()
            ->alias('vv')
            ->innerJoin(Videos::tableName() . 'v', 'v.video_id = vv.video_id')
            ->andWhere(['v.created_by' => $userID])
            ->count();

        $numberOfComment = VideoComment::find()
            ->alias('vv')
            ->innerJoin(Videos::tableName() . 'v', 'v.video_id = vv.video_id')
            ->andWhere(['v.created_by' => $userID])
            ->count();

        $numberOfSubscribers = $user->getSubscribes()->count();
        $totalLikes = VideoLike::find()
            ->liked()
            ->alias('vl')
            ->innerJoin(Videos::tableName() . 'v', 'v.video_id = vl.video_id')
            ->andWhere(['v.created_by' => $userID])
            ->count();
        $totalDislikes = VideoLike::find()
            ->disliked()
            ->alias('vl')
            ->innerJoin(Videos::tableName() . 'v', 'v.video_id = vl.video_id')
            ->andWhere(['v.created_by' => $userID])
            ->count();
        $latestSubscribers = Subscriber::find()
            ->andWhere(['channel_id' => $userID])
            ->orderBy('created_at DESC')
            ->all();
        return $this->render('index', [
            'latestVideo' => $lastestVideo,
            'numberOfView' => $numberOfView,
            'numberOfComment' => $numberOfComment,
            'numberOfSubscribers' => $numberOfSubscribers,
            'latestSubscribers' => $latestSubscribers,
            'totalLikes' => $totalLikes,
            'totalDislikes' => $totalDislikes,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'authentication';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
