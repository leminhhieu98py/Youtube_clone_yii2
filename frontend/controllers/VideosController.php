<?php

namespace frontend\controllers;

use common\models\Videos;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii;

class VideosController extends Controller
{
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
        $video = Videos::findOne($id);
        if (!$video) {
            throw new NotFoundHttpException("Video does not exist anymore!");
        }
        $this->layout = 'authentication';
        return $this->render('view', [
            'model' => $video
        ]);
    }
}
