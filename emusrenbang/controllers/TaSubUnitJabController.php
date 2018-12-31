<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\TaSubUnitJab;
use emusrenbang\models\TaSubUnitJabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaSubUnitJabController implements the CRUD actions for TaSubUnitJab model.
 */
class TaSubUnitJabController extends Controller
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
     * Lists all TaSubUnitJab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaSubUnitJabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaSubUnitJab model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Jab
     * @param integer $No_Urut
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut),
        ]);
    }

    /**
     * Creates a new TaSubUnitJab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaSubUnitJab();

        $model->Tahun=2019;
        $identity=Yii::$app->user->identity;
        $model->Kd_Urusan=$identity->id_urusan;
        $model->Kd_Bidang=$identity->id_bidang;
        $model->Kd_Unit=$identity->id_skpd;
        $model->Kd_Sub=$identity->id_subunit;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Jab' => $model->Kd_Jab, 'No_Urut' => $model->No_Urut]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaSubUnitJab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Jab
     * @param integer $No_Urut
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Jab' => $model->Kd_Jab, 'No_Urut' => $model->No_Urut]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaSubUnitJab model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Jab
     * @param integer $No_Urut
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaSubUnitJab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Jab
     * @param integer $No_Urut
     * @return TaSubUnitJab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Jab, $No_Urut)
    {
        if (($model = TaSubUnitJab::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Jab' => $Kd_Jab, 'No_Urut' => $No_Urut])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
