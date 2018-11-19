<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\LevelAplikasi;
use emusrenbang\models\LevelAplikasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LevelAplikasiController implements the CRUD actions for LevelAplikasi model.
 */
class LevelAplikasiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LevelAplikasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LevelAplikasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LevelAplikasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LevelAplikasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LevelAplikasi();

        $apps = $this->getcontrollersandactions();
        foreach($apps as $k=>$d)
        {
        	$k=str_replace('Controller','',$k);
        	$char=lcfirst($k);
        	preg_match_all('/[A-Z]/',$char, $d);

    		foreach($d[0] as $d1){
    			$char=str_replace($d1, '-'.strtolower($d1), $char);
    		}
        	$data[$char]=$char;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data' => $data,
            ]);
        }
    }

    /**
     * Updates an existing LevelAplikasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    private function getcontrollersandactions()
	{
    	$controllerlist = [];
    	if ($handle = opendir('../controllers')) {
        	while (false !== ($file = readdir($handle))) {
            	if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
               	 $controllerlist[] = $file;
            	}
        	}
        	closedir($handle);
    	}
    	asort($controllerlist);
    	$fulllist = [];
    	foreach ($controllerlist as $controller):
        	$handle = fopen('../controllers/' . $controller, "r");

        	if ($handle) {
            	while (($line = fgets($handle)) !== false) {
                	if (preg_match('/public function action(.*?)\(/', $line, $display)):
                    	if (strlen($display[1]) > 2):
                        	$fulllist[substr($controller, 0, -4)][] = strtolower($display[1]);
                    	endif;
                	endif;
            	}
        	}
        	fclose($handle);
    	endforeach;
    	return $fulllist;
	}


    /**
     * Deletes an existing LevelAplikasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LevelAplikasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LevelAplikasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LevelAplikasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
