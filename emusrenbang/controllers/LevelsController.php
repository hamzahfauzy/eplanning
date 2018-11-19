<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\Levels;
use emusrenbang\models\LevelsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AuthItem;

/**
 * LevelsController implements the CRUD actions for Levels model.
 */
class LevelsController extends Controller
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
     * Lists all Levels models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LevelsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Levels model.
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
     * Creates a new Levels model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Levels();
        $modauth = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        		$modauth->name = $model->level;
        		$modauth->type = 3;
        		$modauth->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Levels model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $name = $model->level;
		  $modauth = $this->findModauth($name);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        		$modauth->name = $model->level;
        		$modauth->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Levels model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->level;
        $modauth = $this->findModauth($name);
        $model->delete();
        $modauth->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Levels model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Levels the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Levels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModauth($name) {
    		if (($model = AuthItem::find()->where(['name'=>$name])->one()) !== null){
    			return $model;
    		}else{
    			throw new NotFoundHttpException('The requested page does not exist.');
    		}
    }
}
