<?php

namespace emusrenbang\controllers;

use Yii;
//use app\models\RefRek4;
use \common\models\RefRek4;

//use app\models\RefRek4Search;
use referensi\models\search\RefRek4Search;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefRek4Controller implements the CRUD actions for RefRek4 model.
 */
class RefRek4Controller extends Controller
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
     * Lists all RefRek4 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefRek4Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefRek4 model.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @return mixed
     */
    public function actionView($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4),
        ]);
    }

    /**
     * Creates a new RefRek4 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefRek4();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3, 'Kd_Rek_4' => $model->Kd_Rek_4]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefRek4 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @return mixed
     */
    public function actionUpdate($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4)
    {
        $model = $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3, 'Kd_Rek_4' => $model->Kd_Rek_4]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefRek4 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @return mixed
     */
    public function actionDelete($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4)
    {
        $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetdata($rek1,$rek2,$rek3)
    {
        $this->layout='blank';
        $model = RefRek4::find()->where(['Kd_Rek_1'=>$rek1,'Kd_Rek_2'=>$rek2,'Kd_Rek_3'=>$rek3])->all();
            echo "<option>Pilih Obyek</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Rek_4]'>$d[Nm_Rek_4]</option>";
        }
    }

    /**
     * Finds the RefRek4 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @return RefRek4 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4)
    {
        if (($model = RefRek4::findOne(['Kd_Rek_1' => $Kd_Rek_1, 'Kd_Rek_2' => $Kd_Rek_2, 'Kd_Rek_3' => $Kd_Rek_3, 'Kd_Rek_4' => $Kd_Rek_4])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
