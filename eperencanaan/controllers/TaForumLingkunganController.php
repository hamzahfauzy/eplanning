<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\search\TaForumLingkunganSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaForumLingkunganController implements the CRUD actions for TaForumLingkungan model.
 */
class TaForumLingkunganController extends Controller
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
     * Lists all TaForumLingkungan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaForumLingkunganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaForumLingkungan model.
     * @param string $Tahun
     * @param integer $Kd_Ta_Forum_Lingkungan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran),
        ]);
    }

    /**
     * Creates a new TaForumLingkungan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaForumLingkungan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Forum_Lingkungan' => $model->Kd_Ta_Forum_Lingkungan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaForumLingkungan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Ta_Forum_Lingkungan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        $model = $this->findModel($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Forum_Lingkungan' => $model->Kd_Ta_Forum_Lingkungan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaForumLingkungan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Ta_Forum_Lingkungan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        $this->findModel($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaForumLingkungan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Ta_Forum_Lingkungan
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @param integer $Kd_Kel
     * @param integer $Kd_Urut_Kel
     * @param integer $Kd_Lingkungan
     * @param integer $Kd_Jalan
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Klasifikasi
     * @param integer $Kd_Satuan
     * @param integer $Kd_Sasaran
     * @return TaForumLingkungan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Ta_Forum_Lingkungan, $Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan, $Kd_Jalan, $Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg, $Kd_Klasifikasi, $Kd_Satuan, $Kd_Sasaran)
    {
        if (($model = TaForumLingkungan::findOne(['Tahun' => $Tahun, 'Kd_Ta_Forum_Lingkungan' => $Kd_Ta_Forum_Lingkungan, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan, 'Kd_Jalan' => $Kd_Jalan, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg, 'Kd_Klasifikasi' => $Kd_Klasifikasi, 'Kd_Satuan' => $Kd_Satuan, 'Kd_Sasaran' => $Kd_Sasaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
