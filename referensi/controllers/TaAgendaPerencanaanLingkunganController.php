<?php

namespace referensi\controllers;

use Yii;
use eperencanaan\models\TaAgendaPerencanaanLingkungan;
use eperencanaan\models\search\TaAgendaPerencanaanLingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaAgendaPerencanaanLingkunganController implements the CRUD actions for TaAgendaPerencanaanLingkungan model.
 */
class TaAgendaPerencanaanLingkunganController extends Controller
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
     * Lists all TaAgendaPerencanaanLingkungan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaAgendaPerencanaanLingkunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaAgendaPerencanaanLingkungan model.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan),
        ]);
    }

    /**
     * Creates a new TaAgendaPerencanaanLingkungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaAgendaPerencanaanLingkungan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaAgendaPerencanaanLingkungan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan)
    {
        $model = $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaAgendaPerencanaanLingkungan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan)
    {
        $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaAgendaPerencanaanLingkungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @return TaAgendaPerencanaanLingkungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan)
    {
        if (($model = TaAgendaPerencanaanLingkungan::findOne(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
