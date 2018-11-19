<?php

namespace userlevel\controllers;

use Yii;
use common\models\TaUserAplikasi;
use common\models\search\TaUserAplikasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RefAplikasi;

/**
 * TaUserAplikasiController implements the CRUD actions for TaUserAplikasi model.
 */
class TaUserAplikasiController extends Controller
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
     * Lists all TaUserAplikasi models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new TaUserAplikasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single TaUserAplikasi model.
     * @param integer $Kd_User
     * @param string $Kd_Aplikasi
     * @return mixed
     */
    public function actionView($Kd_User, $Kd_Aplikasi)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_User, $Kd_Aplikasi),
        ]);
    }

    /**
     * Creates a new TaUserAplikasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new TaUserAplikasi();
        
        $DNModelAplikasi = RefAplikasi::find()->all();
        foreach($DNModelAplikasi as $DNData){
        	$DNDataAplikasi[$DNData['Kd_Aplikasi']]=$DNData['Nm_Aplikasi'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_User' => $model->Kd_User, 'Kd_Aplikasi' => $model->Kd_Aplikasi]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id' => $id,
                'DNDataAplikasi' => $DNDataAplikasi,
            ]);
        }
    }

    /**
     * Updates an existing TaUserAplikasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_User
     * @param string $Kd_Aplikasi
     * @return mixed
     */
    public function actionUpdate($Kd_User, $Kd_Aplikasi)
    {
        $model = $this->findModel($Kd_User, $Kd_Aplikasi);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_User' => $model->Kd_User, 'Kd_Aplikasi' => $model->Kd_Aplikasi]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaUserAplikasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_User
     * @param string $Kd_Aplikasi
     * @return mixed
     */
    public function actionDelete($Kd_User, $Kd_Aplikasi)
    {
        $this->findModel($Kd_User, $Kd_Aplikasi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaUserAplikasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_User
     * @param string $Kd_Aplikasi
     * @return TaUserAplikasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_User, $Kd_Aplikasi)
    {
        if (($model = TaUserAplikasi::findOne(['Kd_User' => $Kd_User, 'Kd_Aplikasi' => $Kd_Aplikasi])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
