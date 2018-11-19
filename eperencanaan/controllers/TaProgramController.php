<?php

namespace eperencanaan\controllers;

use Yii;
use eperencanaan\models\TaProgram;
use eperencanaan\models\search\TaProgramSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaProgramController implements the CRUD actions for TaProgram model.
 */
class TaProgramController extends Controller
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
     * Lists all TaProgram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaProgram model.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param string $Ket_Prog
     * @param integer $Kd_Urusan1
     * @param integer $Kd_Bidang1
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1),
        ]);
    }

    /**
     * Creates a new TaProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaProgram();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Ket_Prog' => $model->Ket_Prog, 'Kd_Urusan1' => $model->Kd_Urusan1, 'Kd_Bidang1' => $model->Kd_Bidang1]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param string $Ket_Prog
     * @param integer $Kd_Urusan1
     * @param integer $Kd_Bidang1
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Ket_Prog' => $model->Ket_Prog, 'Kd_Urusan1' => $model->Kd_Urusan1, 'Kd_Bidang1' => $model->Kd_Bidang1]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaProgram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param string $Ket_Prog
     * @param integer $Kd_Urusan1
     * @param integer $Kd_Bidang1
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $ID_Prog
     * @param string $Ket_Prog
     * @param integer $Kd_Urusan1
     * @param integer $Kd_Bidang1
     * @return TaProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $ID_Prog, $Ket_Prog, $Kd_Urusan1, $Kd_Bidang1)
    {
        if (($model = TaProgram::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'ID_Prog' => $ID_Prog, 'Ket_Prog' => $Ket_Prog, 'Kd_Urusan1' => $Kd_Urusan1, 'Kd_Bidang1' => $Kd_Bidang1])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
