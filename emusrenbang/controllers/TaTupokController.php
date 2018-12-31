<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaTupok;
use common\models\search\TaTupokSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * TaTupokController implements the CRUD actions for TaTupok model.
 */
class TaTupokController extends Controller
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
     * Lists all TaTupok models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaTupokSearch();
        $dataProvider = $searchModel->searchUnit(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaTupok model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Tupok
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok),
        ]);
    }

    /**
     * Creates a new TaTupok model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaTupok();

        $unit = Yii::$app->levelcomponent->getUnit();

        $model->Tahun=2019;
        $model->Kd_Urusan=$unit['Kd_Urusan'];
        $model->Kd_Bidang=$unit['Kd_Bidang'];
        $model->Kd_Unit=$unit['Kd_Unit'];
        $model->Kd_Sub=$unit['Kd_Sub_Unit'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Tupok' => $model->No_Tupok]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaTupok model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Tupok
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Tupok' => $model->No_Tupok]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaTupok model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Tupok
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaTupok model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Tupok
     * @return TaTupok the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Tupok)
    {
        if (($model = TaTupok::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'No_Tupok' => $No_Tupok])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
