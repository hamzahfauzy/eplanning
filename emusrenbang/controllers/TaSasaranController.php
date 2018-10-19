<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaSasaran;
use common\models\TaMisi;
use common\models\TaTujuan;
use common\models\search\TaSasaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TaSasaranController implements the CRUD actions for TaSasaran model.
 */
class TaSasaranController extends Controller
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
     * Lists all TaSasaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaSasaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaSasaran model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran),
        ]);
    }

    /**
     * Creates a new TaSasaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaSasaran();
        $dataMisi = ArrayHelper::map(TaMisi::findAll(Yii::$app->levelcomponent->PosisiUnit()), 'No_Misi', 'Ur_Misi');

        $unit = Yii::$app->levelcomponent->getUnit();

        $model->Tahun=date('Y');
        $model->Kd_Urusan=$unit['Kd_Urusan'];
        $model->Kd_Bidang=$unit['Kd_Bidang'];
        $model->Kd_Unit=$unit['Kd_Unit'];
        $model->Kd_Sub=$unit['Kd_Sub_Unit'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataMisi' => $dataMisi,
            ]);
        }
    }

    /**
     * Updates an existing TaSasaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran);
        $dataMisi = ArrayHelper::map(TaMisi::findAll(Yii::$app->levelcomponent->PosisiUnit()), 'No_Misi', 'Ur_Misi');
        $dataTujuan = ArrayHelper::map(TaTujuan::find()
                ->where(Yii::$app->levelcomponent->PosisiUnit())
                ->andWhere(['No_Misi' => $No_Misi])
                ->all(), 'No_Tujuan', 'Ur_Tujuan');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataMisi' => $dataMisi,
                'dataTujuan' => $dataTujuan,
            ]);
        }
    }

    /**
     * Deletes an existing TaSasaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaSasaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @param integer $No_Sasaran
     * @return TaSasaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan, $No_Sasaran)
    {
        if (($model = TaSasaran::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan, 'No_Sasaran' => $No_Sasaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetTujuan($No_Misi){
        $dataTujuan = TaTujuan::find()
            ->where(Yii::$app->levelcomponent->PosisiUnit())
            ->andWhere(['No_Misi' => $No_Misi])
            ->all();
        echo '<option value = "" >Pilih Tujuan</option>';
        foreach ($dataTujuan as $key => $value) {
            echo '<option value = "'.$value->No_Tujuan.'" >'.$value->Ur_Tujuan.'</option>';
        }
    }
}
