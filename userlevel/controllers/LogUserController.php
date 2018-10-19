<?php

namespace userlevel\controllers;

use Yii;

class LogUserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new \userlevel\models\searchs\User();
        	
      	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				
      	return $this->render('index', [
          	'searchModel' => $searchModel,
          	'dataProvider' => $dataProvider,
      	]);
    }

    public function actionDetail()
    {
      // $data = Yii::$app->request->queryParams;
      // echo $data['user_id'];
      // die();
    	$searchModel = new \userlevel\models\searchs\LogSearch();
      	
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			
    	return $this->render('detail', [
        	'searchModel' => $searchModel,
        	'dataProvider' => $dataProvider,
    	]);
    }

}
