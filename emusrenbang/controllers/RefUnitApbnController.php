<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\RefUnitApbn;
use emusrenbang\models\search\RefUnitApbnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefUnitApbnController implements the CRUD actions for RefUnitApbn model.
 */
class RefUnitApbnController extends Controller
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
     * Lists all RefUnitApbn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefUnitApbnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefUnitApbn model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit),
        ]);
    }

    /**
     * Creates a new RefUnitApbn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefUnitApbn();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefUnitApbn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $model = $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefUnitApbn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefUnitApbn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return RefUnitApbn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        if (($model = RefUnitApbn::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
