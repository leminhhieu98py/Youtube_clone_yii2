<?php
namespace backend\controllers;

use yii\web\Controller;

class VideoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index.php');
    }
}