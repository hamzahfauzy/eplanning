<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\TaPaguKegiatan;
use emusrenbang\models\TaPaguKegiatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefProgram;
use common\models\RefKegiatan;
use common\models\RefSubUnit;
use yii\helpers\ArrayHelper;

/**
 * TaPaguKegiatanController implements the CRUD actions for TaPaguKegiatan model.
 */
class TaPaguKegiatanController extends Controller
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
     * Lists all TaPaguKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaPaguKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $urusan = ArrayHelper::map(RefUrusan::find()->all(),
                          'Kd_Urusan',
                          'Nm_Urusan'
                        );

        $bidang = ArrayHelper::map(RefBidang::find()
                    ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                    ->all(),
                    'Kd_Bidang',
                    'Nm_Bidang'
                );

        $unit = ArrayHelper::map(RefUnit::find()
                ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                ->all(),
                'Kd_Unit',
                'Nm_Unit'
            );

        $subunit = ArrayHelper::map(RefSubUnit::find()
                        ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                        ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                        ->andwhere(['Kd_Unit' => $searchModel->Kd_Unit])
                        ->all(),
                          'Kd_Sub',
                          'Nm_Sub_Unit'
                        );

        $program = ArrayHelper::map(RefProgram::find()
                        ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                        ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                        ->all(),
                            'Kd_Prog',
                            'Ket_Program'
                        );

        $kegiatan = ArrayHelper::map(RefKegiatan::find()
                        ->where(['Kd_Urusan' => $searchModel->Kd_Urusan])
                        ->andwhere(['Kd_Bidang' => $searchModel->Kd_Bidang])
                        ->andwhere(['Kd_Prog' => $searchModel->Kd_Prog])
                        ->all(),
                            'Kd_Keg',
                            'Ket_Kegiatan'
                        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'urusan' => $urusan,
            'bidang' => $bidang,
            'unit' => $unit,
            'subunit' => $subunit,
            'program' => $program,
            'kegiatan' => $kegiatan,
        ]);
    }

    /**
     * Displays a single TaPaguKegiatan model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg),
        ]);
    }

    /**
     * Creates a new TaPaguKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPaguKegiatan();
		$model->Tahun = date('Y')+1;
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPaguKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaPaguKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaPaguKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @return TaPaguKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        if (($model = TaPaguKegiatan::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
