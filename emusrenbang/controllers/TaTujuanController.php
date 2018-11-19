<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaMisi;
use common\models\TaTujuan;
use common\models\search\TaTujuanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TaTujuanController implements the CRUD actions for TaTujuan model.
 */
class TaTujuanController extends Controller
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
     * Lists all TaTujuan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaTujuanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaTujuan model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan)
    {
        $misi = TaTujuan::find()
                ->where(['No_Misi'=>$No_Misi])
                ->one();

        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan),
            'misi' => $misi,
        ]);
    }

    /**
     * Creates a new TaTujuan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dataMisi = ArrayHelper::map(TaMisi::find()->all(), 'No_Misi', 'Ur_Misi');

        $model = new TaTujuan();

        $model->Tahun = date('Y');
        $posisi = Yii::$app->levelcomponent->PosisiUnit();
        $model->Kd_Urusan   = $posisi['Kd_Urusan'];
        $model->Kd_Bidang   = $posisi['Kd_Bidang'];
        $model->Kd_Unit     = $posisi['Kd_Unit'];
        $model->Kd_Sub      = $posisi['Kd_Sub'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataMisi' => $dataMisi,
            ]);
        }
    }

    /**
     * Updates an existing TaTujuan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan)
    {
        $dataMisi = ArrayHelper::map(TaMisi::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->all(), 'No_Misi', 'Ur_Misi');

        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataMisi' => $dataMisi,
            ]);
        }
    }

    /**
     * Deletes an existing TaTujuan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaTujuan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $No_Misi
     * @param integer $No_Tujuan
     * @return TaTujuan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi, $No_Tujuan)
    {
        if (($model = TaTujuan::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'No_Misi' => $No_Misi, 'No_Tujuan' => $No_Tujuan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
