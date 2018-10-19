<?php

namespace emusrenbang\controllers;

use Yii;
use common\models\TaPaguSubUnit;
use common\models\search\TaPaguSubUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TaSubUnit;
use common\models\TaPaguUnit;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;






/**
 * TaPaguSubUnitController implements the CRUD actions for TaPaguSubUnit model.
 */
class TaPaguSubUnitController extends Controller
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
     * Lists all TaPaguSubUnit models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = TaPaguSubUnit::find()->all();
        $searchModel = new TaPaguSubUnitSearch();
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'urusan' => $urusan,
            'bidang' => $bidang,
            'unit' => $unit,
            'subunit' => $subunit,
        ]);
    }

    /**
     * Displays a single TaPaguSubUnit model.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
		$subunit = RefSubUnit::find()
					->where(['Kd_Urusan'=>$Kd_Urusan])
					->andwhere(['Kd_Bidang'=>$Kd_Bidang])
					->andwhere(['Kd_Unit'=>$Kd_Unit])
					->andwhere(['Kd_Sub'=>$Kd_Sub])
					->one();
		
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub),
			'subunit'=>$subunit
        ]);
    }

    /**
     * Creates a new TaPaguSubUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaPaguSubUnit();
		
		//$model->Tahun = date('Y')+1;
		$model->Tahun = date('Y');
		
		
		//return;

        if ($model->load(Yii::$app->request->post())) {
			if($model->save(false)){
				return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]);
			}
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaPaguSubUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub);

        if ($model->load(Yii::$app->request->post())) {
			if($model->save(false)){
				return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]);
			}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaPaguSubUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Tahun
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
     * Finds the TaPaguSubUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @return TaPaguSubUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {
        if (($model = TaPaguSubUnit::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionList() {
        $date = date('Y');
        
        $unit = TaSubUnit::find()->all();
        foreach ($unit as $data) {
            $cek = TaPaguSubUnit::findOne([
                        'Tahun' => $date,
                        'Kd_Urusan' => $data->Kd_Urusan,
                        'Kd_Bidang' => $data->Kd_Bidang,
                        'Kd_Unit' => $data->Kd_Unit,
                        'Kd_Sub' => $data->Kd_Sub,
            ]);
            if (!($cek)) {
                $new = new TaPaguSubUnit();
                $new->Kd_Urusan = $data->Kd_Urusan;
                $new->Kd_Bidang = $data->Kd_Bidang;
                $new->Kd_Unit = $data->Kd_Unit;
                $new->Kd_Sub =$data->Kd_Sub;
                $new->Tahun = date('Y');
                $new->pagu = 0;
                $new->save();
            }
        }
        if ($post = Yii::$app->request->post()) {
            foreach ($post['pagu'] as $Kd_Urusan => $a) {
                foreach ($a as $Kd_Bidang => $b) {
                    foreach ($b as $Kd_Unit => $c) {
                        $paguUnit = 0;
                        foreach ($c as $Kd_Sub => $pagu) {
                            $updatePaguSubUnit = TaPaguSubUnit::findOne([
                                        'Kd_Urusan' => $Kd_Urusan,
                                        'Kd_Bidang' => $Kd_Bidang,
                                        'Kd_Unit' => $Kd_Unit,
                                        'Kd_Sub' => $Kd_Sub,
                                        'Tahun' => $date,
                            ]);
                            $pagu = str_replace(".", "", $pagu);
                            $updatePaguSubUnit->pagu = $pagu;
                            $updatePaguSubUnit->update();
                            $paguUnit += $pagu;
                        }
                        $updatePaguUnit = TaPaguUnit::findOne([
                                    'Kd_Urusan' => $Kd_Urusan,
                                    'Kd_Bidang' => $Kd_Bidang,
                                    'Kd_Unit' => $Kd_Unit,
                                    'Tahun' => $date,
                        ]);
                        //$updatePaguUnit->pagu = $paguUnit;
                        //$updatePaguUnit->update();
                    }
                }
            }
        }
        $model = TaPaguSubUnit::find()
                ->where(['Tahun' => $date])
                ->all();
        return $this->render('list', [
                    'model' => $model,
        ]);
    }

    public function getKota() {
        return Yii::$app->pengaturan->Kolom('Nm_Pemda');
    }

    public function actionCetak() 
    {
        $model = TaPaguSubUnit::find()->all();

        $paguUnit = (new \yii\db\Query())->from('Ta_Pagu_Sub_Unit');
        $paguIndikatif = $paguUnit->sum('pagu');


        $paguPakai = (new \yii\db\Query())->from('Ta_Belanja_Rinc_Sub');
        $pemakaian = $paguPakai->sum('Total');


        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_FOLIO,
            'content' => $this->renderPartial('cetak', [
               'model' => $model,
               'paguIndikatif' => $paguIndikatif,
               'pemakaian' =>$pemakaian,
            ]),
            'options' => [
                'title' => 'Pagu Sub Unit',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 
                    Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
            (date('H:i:s'))
                    ],
                'SetFooter' => ['Bappeda Kota Medan|Halaman {PAGENO}|Tvic10'],
            ]
        ]);
        return $pdf->render();
    }
}
