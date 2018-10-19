<?php
namespace userlevel\controllers;
use Yii;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	//print_r(Yii::$app->id);
        return $this->render('index');
    }
}
