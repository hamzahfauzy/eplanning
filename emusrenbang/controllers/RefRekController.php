<?php

namespace app\controllers;

use Yii;
use app\models\RefRek3;
use app\models\RefRek3Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefRekController implements the CRUD actions for RefRek3 model.
 */
class RefRekController extends Controller
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
     * Lists all RefRek3 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefRek3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefRek3 model.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return mixed
     */
    public function actionView($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3),
        ]);
    }

    /**
     * Creates a new RefRek3 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefRek3();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefRek3 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return mixed
     */
    public function actionUpdate($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        $model = $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefRek3 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return mixed
     */
    public function actionDelete($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefRek3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @return RefRek3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        if (($model = RefRek3::findOne(['Kd_Rek_1' => $Kd_Rek_1, 'Kd_Rek_2' => $Kd_Rek_2, 'Kd_Rek_3' => $Kd_Rek_3])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
