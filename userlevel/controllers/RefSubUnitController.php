<?php

namespace userlevel\controllers;

use Yii;
use common\models\RefSubUnit;
use common\models\search\RefSubUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefSubUnitController implements the CRUD actions for RefSubUnit model.
 */
class RefSubUnitController extends Controller
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
     * Lists all RefSubUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSubUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefSubUnit model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        return $this->render('view', [
            'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub),
        ]);
    }

    /**
     * Creates a new RefSubUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefSubUnit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RefSubUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionUpdate($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        $model = $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RefSubUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionDelete($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefSubUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return RefSubUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        if (($model = RefSubUnit::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
