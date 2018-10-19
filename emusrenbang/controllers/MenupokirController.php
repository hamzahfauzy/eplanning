<?php

namespace emusrenbang\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TaPokirReses;

class MenupokirController extends \yii\web\Controller {

	public function actionIndex(){
		$model = TaPokirReses::find()->one();
		if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['index', 'pesan' => 'berhasil']);
        }
		return $this->render("index",["model"=>$model]);
	}

}