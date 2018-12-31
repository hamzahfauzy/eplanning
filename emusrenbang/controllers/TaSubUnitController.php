<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaSubUnit;
use common\models\RefSubUnit;
use common\models\search\TaSubUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TaUserUnit;

/**
 * TaSubUnitController implements the CRUD actions for TaSubUnit model.
 */
class TaSubUnitController extends Controller
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
     * Lists all TaSubUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
		/*
		$unit = Yii::$app->levelcomponent->getUnit();
		
		print_r($unit);
		*/
        $searchModel = new TaSubUnitSearch;
        $dataProvider = $searchModel->searchunit(Yii::$app->request->queryParams);
		$skpd = TaUserUnit::findOne(['Kd_User' => Yii::$app->user->identity->getId()]);
		$tes = TaSubUnit::find()
				->where([
				//'Tahun'=>date('Y') + 1,
				'Tahun'=>2019,
				'Kd_Urusan'=>$skpd->Kd_Urusan,
				'Kd_Bidang'=>$skpd->Kd_Bidang,
                'Kd_Unit'=>$skpd->Kd_Unit,
				'Kd_Sub'=>$skpd->Kd_Sub_Unit,
            ]
				)
				->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'tes' => $tes,
        ]);
    }

    /**
     * Displays a single TaSubUnit model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub),
        ]);
    }

    /**
     * Creates a new TaSubUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaSubUnit();
		
		$skpd = TaUserUnit::findOne(['Kd_User' => Yii::$app->user->identity->getId()]);
        //$model->Tahun=( date('Y') + 1 );
		$model->Tahun=2019;
        $model->Kd_Urusan=$skpd->Kd_Urusan;
        $model->Kd_Bidang=$skpd->Kd_Bidang;
        $model->Kd_Unit=$skpd->Kd_Unit;
		//$model->Kd_Unit=Yii::$app->user->identity->id_skpd;
        $model->Kd_Sub=$skpd->Kd_Sub_Unit;

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]);
        } else {
			//$skpd = TaUserUnit::findOne(['Kd_User' => Yii::$app->user->identity->getId()]);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaSubUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaSubUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaSubUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return TaSubUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        if (($model = TaSubUnit::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
