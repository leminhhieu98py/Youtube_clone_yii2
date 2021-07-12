<?php

namespace frontend\controllers;

use common\models\Subscriber;
use common\models\User;
use common\models\Videos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;

class ChannelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['subscribe',],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
        ];
    }
    public function actionView()
    {
        $params = Yii::$app->request->get();
        $username = $params['username'];
        $page = $params['page'];
        $channel = $this->findChannel($username);

        if ($page == "home") {
            $videos = Videos::find()
                ->creator($channel->id)
                ->published()
                ->latest()
                ->all();

            return $this->render('channel', [
                'channel' => $channel,
                'videos' => $videos,
                'page' => $page
            ]);
        }

        if ($page == "videos") {
            $videos = Videos::find()
                ->creator($channel->id)
                ->published()
                ->latest()
                ->all();
            return $this->render('channel', [
                'channel' => $channel,
                'videos' => $videos,
                'page' => $page
            ]);
        }
        return $this->render('channel', [
            'channel' => $channel,
            'page' => $page
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

    public function actionSubscribe()
    {
        $params = Yii::$app->request->get();
        $username = $params['username'];
        $channel = $this->findChannel($username);
        $userID = Yii::$app->user->id;

        $subscriber = $channel->isSubscribed($userID);
        if (!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = $userID;
            $subscriber->created_at = time();
            $subscriber->save();
            Yii::$app->mailer->compose([
                'html' => 'subscriber-html',
                'text' => 'subscriber-text'
            ], [
                'channel' => $channel,
                'user' => Yii::$app->user->identity,
            ])
                ->setFrom(Yii::$app->params['senderEmail'])
                ->setTo($channel->email)
                ->setSubject('You have a new subscriber. Keep moving <3')
                ->send();
        } else {
            $subscriber->delete();
        }
        return $this->renderPartial('_subscribe', [
            'channel' => $channel,
        ]);
    }
}
