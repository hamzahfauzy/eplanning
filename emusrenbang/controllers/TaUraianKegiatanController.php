<?php

namespace app\controllers;

use Yii;
use app\models\TaUraianKegiatan;
use app\models\TaUraianKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaUraianKegiatanController implements the CRUD actions for TaUraianKegiatan model.
 */
class TaUraianKegiatanController extends Controller
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
     * Lists all TaUraianKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaUraianKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaUraianKegiatan model.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        return $this->render('view', [
            'model' => $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg),
        ]);
    }

    /**
     * Creates a new TaUraianKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaUraianKegiatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaUraianKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionUpdate($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        $model = $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaUraianKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaUraianKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return TaUraianKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog, $Kd_Keg)
    {
        if (($model = TaUraianKegiatan::findOne(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
