<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaPaguUnit;
use emusrenbang\models\TaPaguUnitSearch;//diubah dari use app\models\TaPaguUnitSearch;
use common\models\RefUnit;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaPaguUnitController implements the CRUD actions for TaPaguUnit model.
 */
class TaPaguUnitController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all TaPaguUnit models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaPaguUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaPaguUnit model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
		$subunit = RefUnit::find()
					->where(['Kd_Urusan'=>$Kd_Urusan])
					->andwhere(['Kd_Bidang'=>$Kd_Bidang])
					->andwhere(['Kd_Unit'=>$Kd_Unit])
					->one();
		
        return $this->render('view', [
                    'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit),
					'subunit'=>$subunit
        ]);
    }

    public function actionList() {
        $date = date('Y');
        /*
        $unit = RefUnit::find()->all();
        foreach ($unit as $data) {
            $cek = TaSubUnit::findOne([
                        'Kd_Urusan' => $data->Kd_Urusan,
                        'Kd_Bidang' => $data->Kd_Bidang,
                        'Kd_Unit' => $data->Kd_Unit,
                        'Tahun' => $date,
            ]);
            if (!($cek)) {
                $new = new TaPaguUnit();
                $new->Kd_Urusan = $data->Kd_Urusan;
                $new->Kd_Bidang = $data->Kd_Bidang;
                $new->Kd_Unit = $data->Kd_Unit;
                $new->Tahun = date('Y');
                $new->pagu = 0;
                $new->save();
            }
        }
         * 
         */
        if ($post = Yii::$app->request->post()) {
            foreach ($post['pagu'] as $Kd_Urusan => $a) {
                foreach ($a as $Kd_Bidang => $b) {
                    foreach ($b as $Kd_Unit => $pagu) {
                        $update = TaPaguUnit::findOne([
                                    'Kd_Urusan' => $Kd_Urusan,
                                    'Kd_Bidang' => $Kd_Bidang,
                                    'Kd_Unit' => $Kd_Unit,
                                    'Tahun' => $date,
                        ]);
                        $update->pagu = str_replace(".", "", $pagu);
                        $update->update();
                    }
                }
            }
        }
        $model = TaPaguUnit::find()
                ->where(['Tahun' => $date])
                ->all();
        return $this->render('list', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new TaPaguUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaPaguUnit();

        $model->Tahun = date('Y')+1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPaguUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaPaguUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaPaguUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @return TaPaguUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
        if (($model = TaPaguUnit::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
