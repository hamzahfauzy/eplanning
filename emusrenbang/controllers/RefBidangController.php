<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\RefBidang;
use common\models\search\RefBidangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefBidangController implements the CRUD actions for RefBidang model.
 */
class RefBidangController extends Controller
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
     * Lists all RefBidang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefBidangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefBidang model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Urusan, $Kd_Bidang),
        ]);
    }

    /**
     * Creates a new RefBidang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefBidang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefBidang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @return mixed
     */
    public function actionUpdate($Kd_Urusan, $Kd_Bidang)
    {
        $model = $this->findModel($Kd_Urusan, $Kd_Bidang);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefBidang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang)
    {
        $this->findModel($Kd_Urusan, $Kd_Bidang)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefBidang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @return RefBidang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang)
    {
        if (($model = RefBidang::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
