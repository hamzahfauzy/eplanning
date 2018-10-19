<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaKecamatanPaguIndikatif;
use eperencanaan\models\search\TaKecamatanPaguIndikatifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaKecamatanPaguIndikatifController implements the CRUD actions for TaKecamatanPaguIndikatif model.
 */
class TaKecamatanPaguIndikatifController extends Controller
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
     * Lists all TaKecamatanPaguIndikatif models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaKecamatanPaguIndikatifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaKecamatanPaguIndikatif model.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec),
        ]);
    }

    /**
     * Creates a new TaKecamatanPaguIndikatif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaKecamatanPaguIndikatif();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaKecamatanPaguIndikatif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        $model = $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaKecamatanPaguIndikatif model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        $this->findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaKecamatanPaguIndikatif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Prov
     * @param integer $Kd_Kab
     * @param integer $Kd_Kec
     * @return TaKecamatanPaguIndikatif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        if (($model = TaKecamatanPaguIndikatif::findOne(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
