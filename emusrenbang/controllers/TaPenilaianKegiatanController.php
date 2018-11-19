<?php

namespace emusrenbang\controllers;

use Yii;
use app\models\TaPenilaianKegiatan;
use app\models\TaPenilaianKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaPenilaianKegiatanController implements the CRUD actions for TaPenilaianKegiatan model.
 */
class TaPenilaianKegiatanController extends Controller
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
     * Lists all TaPenilaianKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPenilaianKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaPenilaianKegiatan model.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @param integer $ID_Penilaian
     * @return mixed
     */
    public function actionView($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian)
    {
        return $this->render('view', [
            'model' => $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian),
        ]);
    }

    /**
     * Creates a new TaPenilaianKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPenilaianKegiatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan, 'ID_Penilaian' => $model->ID_Penilaian]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPenilaianKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @param integer $ID_Penilaian
     * @return mixed
     */
    public function actionUpdate($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian)
    {
        $model = $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan, 'ID_Penilaian' => $model->ID_Penilaian]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaPenilaianKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @param integer $ID_Penilaian
     * @return mixed
     */
    public function actionDelete($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian)
    {
        $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaPenilaianKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param string $Kd_Unit
     * @param integer $Kd_Program
     * @param string $Kd_Kegiatan
     * @param integer $ID_Penilaian
     * @return TaPenilaianKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Program, $Kd_Kegiatan, $ID_Penilaian)
    {
        if (($model = TaPenilaianKegiatan::findOne(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Program' => $Kd_Program, 'Kd_Kegiatan' => $Kd_Kegiatan, 'ID_Penilaian' => $ID_Penilaian])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
