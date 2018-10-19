<?php

namespace emusrenbang\controllers;

use Yii;
//use emusrenbang\models\RefRek2;

use \common\models\RefRek2;
//use app\models\RefRek1Search;
use \referensi\models\search\RefRek2Search;

//use emusrenbang\models\RefRek2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefRek2Controller implements the CRUD actions for RefRek2 model.
 */
class RefRek2Controller extends Controller
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
     * Lists all RefRek2 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefRek2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefRek2 model.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @return mixed
     */
    public function actionView($Kd_Rek_1, $Kd_Rek_2)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Rek_1, $Kd_Rek_2),
        ]);
    }

    /**
     * Creates a new RefRek2 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefRek2();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefRek2 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @return mixed
     */
    public function actionUpdate($Kd_Rek_1, $Kd_Rek_2)
    {
        $model = $this->findModel($Kd_Rek_1, $Kd_Rek_2);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefRek2 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @return mixed
     */
    public function actionDelete($Kd_Rek_1, $Kd_Rek_2)
    {
        $this->findModel($Kd_Rek_1, $Kd_Rek_2)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetdata($rek1)
    {
        $this->layout='blank';
        $model = RefRek2::find()->where(['Kd_Rek_1'=>$rek1])->all();
            echo "<option>Pilih Kelompok</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Rek_2]'>$d[Nm_Rek_2]</option>";
        }
    }

    /**
     * Finds the RefRek2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @return RefRek2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Rek_1, $Kd_Rek_2)
    {
        if (($model = RefRek2::findOne(['Kd_Rek_1' => $Kd_Rek_1, 'Kd_Rek_2' => $Kd_Rek_2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
