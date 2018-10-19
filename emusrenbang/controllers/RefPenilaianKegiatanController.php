<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\RefPenilaianKegiatan;
use emusrenbang\models\RefPenilaianKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefPenilaianKegiatanController implements the CRUD actions for RefPenilaianKegiatan model.
 */
class RefPenilaianKegiatanController extends Controller
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
     * Lists all RefPenilaianKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefPenilaianKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefPenilaianKegiatan model.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Program
     * @param integer $ID_Penilaian
     * @return mixed
     */
    public function actionView($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian)
    {
        return $this->render('view', [
            'model' => $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian),
        ]);
    }

    /**
     * Creates a new RefPenilaianKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefPenilaianKegiatan();


        $time=date('y-m-d h:i:s');
        $model->created_at=$time;
        $model->updated_at=$time;
        $username=Yii::$app->user->identity->username;
        $model->tahun=date('Y');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Program' => $model->Kd_Program, 'ID_Penilaian' => $model->ID_Penilaian]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefPenilaianKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Program
     * @param integer $ID_Penilaian
     * @return mixed
     */
    public function actionUpdate($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian)
    {
        $model = $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Program' => $model->Kd_Program, 'ID_Penilaian' => $model->ID_Penilaian]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefPenilaianKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Program
     * @param integer $ID_Penilaian
     * @return mixed
     */
    public function actionDelete($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian)
    {
        $this->findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefPenilaianKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Program
     * @param integer $ID_Penilaian
     * @return RefPenilaianKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Program, $ID_Penilaian)
    {
        if (($model = RefPenilaianKegiatan::findOne(['tahun' => $tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Program' => $Kd_Program, 'ID_Penilaian' => $ID_Penilaian])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
