<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\DetailProgram;
use emusrenbang\models\DetailProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DetailProgramController implements the CRUD actions for DetailProgram model.
 */
class DetailProgramController extends Controller
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
     * Lists all DetailProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetailProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetailProgram model.
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
     * Creates a new DetailProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($kode_program)
    {
        $model = new DetailProgram();

        if ($model->load(Yii::$app->request->post())) {
        		$model->username=Yii::$app->user->username;
        		if($model->save()){
        			return $this->redirect(['view', 'id' => $kode_program]);
        		}

        } else {
            return $this->render('create', [
                'model' => $model,
                'kode_program' => $kode_program,
            ]);
        }
    }

    /**
     * Updates an existing DetailProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($kode_program, $tahun)
    {
        $model = $this->findModel($kode_program, $tahun);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_program]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'kode_program' => $kode_program,
            ]);
        }
    }

    /**
     * Deletes an existing DetailProgram model.
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
     * Finds the DetailProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetailProgram::find()->where(['kode_program'=>$id])->orderBy(['tahun'=>SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUpdate($id,$tahun)
    {
        if (($model = DetailProgram::find()->where(['kode_program'=>$id, 'tahun'=>$tahun])->orderBy(['tahun'=>SORT_DESC])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
