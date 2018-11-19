<?php

namespace emusrenbang\controllers;

use Yii;
use app\models\TaIndikator;
use app\models\RefProgram;
use app\models\RefKegiatan;
use app\models\RefIndikator;
use app\models\TaIndikatorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaIndikatorController implements the CRUD actions for TaIndikator model.
 */
class TaIndikatorController extends Controller
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

    public function actionIndikator($kdprog, $kdkeg)
    {
        $tahun=date('Y');
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
        	$urusan=$cookies['urusan']->value;
        	$bidang=$cookies['bidang']->value;
        	$unit=$cookies['skpd']->value;
        	$sub=$cookies['skpd']->value;
        }else{
        	$urusan=Yii::$app->user->identity->id_urusan;
        	$bidang=Yii::$app->user->identity->id_bidang;
        	$unit=Yii::$app->user->identity->id_skpd;
        	$sub=Yii::$app->user->identity->id_subunit;
        }

        $modelInd = new TaIndikator();

        $jIndikator=array(6,7,8);
        if(Yii::$app->request->post()){

            $post=Yii::$app->request->post();
            if($post['tolakUkur'] and $post['targetAngka'] and $post['targetUraian']){
                foreach ($jIndikator as $key => $value) {

                    $findT=$this->findModelData($tahun, $urusan, $bidang, $unit, $sub, $kdprog, $kdkeg, $value);
                    if($findT){
                        $findT->delete();
                    }

                    $mTaInd = new TaIndikator();

                    $mTaInd->Tahun=$tahun;
                    $mTaInd->Kd_Urusan=$urusan;
                    $mTaInd->Kd_Bidang=$bidang;
                    $mTaInd->Kd_Unit=$unit;
                    $mTaInd->Kd_Sub=$sub;
                    $mTaInd->Kd_Prog=$kdprog;
                    $mTaInd->Kd_Keg=$kdkeg;
                    $mTaInd->Kd_Indikator=$value;
                    $mTaInd->Tolak_Ukur=$post['tolakUkur'][$value];
                    $mTaInd->Target_Angka=$post['targetAngka'][$value];
                    $mTaInd->Target_Uraian=$post['targetUraian'][$value];

                    try {
                        if($post['tolakUkur'][$value] and $post['targetAngka'][$value] and $post['targetUraian'][$value]){
                            $mTaInd->save();
                        }
                    } catch (ErrorException $e) {

                    }
                }
            }
        }

        $rowData = TaIndikator::find()->where([
            'Tahun'=>$tahun,
            'Kd_Urusan'=>$urusan,
            'Kd_Bidang'=>$bidang,
            'Kd_Unit'=>$unit,
            'Kd_Sub'=>$sub,
            'Kd_Prog'=>$kdprog,
            'Kd_Keg'=>$kdkeg
        ])->all();

        foreach ($jIndikator as $jk) {
            $findT=$this->findModelData($tahun, $urusan, $bidang, $unit, $sub, $kdprog, $kdkeg, $jk);

            $formData[$jk]['tolakUkur']   =isset($findT) ? $findT->Tolak_Ukur : null;
            $formData[$jk]['targetAngka'] =isset($findT) ? $findT->Target_Angka : 0;
            $formData[$jk]['targetUraian']=isset($findT) ? $findT->Target_Uraian : null;
        }

        $modelPro = RefProgram::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$kdprog])->one();
        $modelKeg = RefKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$kdprog, 'Kd_Keg'=>$kdkeg])->one();
        $modelRefInd=RefIndikator::find()->where(['In', 'Kd_Indikator',  array(6,7,8)])->all();

        return $this->render('newIndikator', [
            'ketProgram'    => $modelPro['Ket_Program'],
            'KdProg'        => $modelPro['Kd_Prog'],
            'ketKegiatan'   => $modelKeg['Ket_Kegiatan'],
            'KdKeg'         => $modelKeg['Kd_Keg'],
            'rowData'       => $rowData,
            'model'         => $modelInd,
            'jenisInd'      => $modelRefInd,
            'formData'      => $formData
        ]);
    }

    /**
     * Lists all TaIndikator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaIndikatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaIndikator model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Indikator
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator),
        ]);
    }

    /**
     * Creates a new TaIndikator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($kdurusan, $kdbidang, $kdprog, $kdkeg)
    {
        $model = new TaIndikator();

        $searchModel = new TaIndikatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model->Kd_Unit=Yii::$app->user->identity->id_skpd;
        $model->Kd_Sub=Yii::$app->user->identity->id_subunit;
        $model->Kd_Urusan=$kdurusan;
        $model->Kd_Bidang=$kdbidang;
        $model->Kd_Prog=$kdprog;
        $model->Kd_Keg=$kdkeg;
        $model->Tahun=date('Y');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'kdurusan'=>$kdurusan, 'kdbidang'=>$kdbidang, 'kdprog'=>$kdprog, 'kdkeg'=>$kdkeg]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModel' => $searchModel,
            	'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionListindikator($kdurusan, $kdbidang, $kdprog, $kdkeg)
    {
        $this->layout="blank";
        $kdunit=Yii::$app->user->identity->id_skpd;
        $kdsub=Yii::$app->user->identity->id_subunit;
        $tahun=date('Y');
        $model=TaIndikator::find()
        ->select('Ta_Indikator.*, Ref_Indikator.Nm_Indikator')
        ->leftJoin('Ref_Indikator', 'Ref_Indikator.Kd_Indikator=Ta_Indikator.Kd_Indikator')
        ->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang, 'Kd_Unit'=>$kdunit, 'Kd_Sub'=>$kdsub, 'Kd_Prog'=>$kdprog, 'Kd_Keg'=>$kdkeg])->all();
        echo "<h3>Indikator Kegiatan</h3>";
        echo "<table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Kode Indikator</th>
                    <th>Tolak Ukur</th>
                    <th>Target Angka</th>
                    <th>Target Uraian</th>
                </tr>
            </thead>
            <tbody>";
            foreach($model as $d){
            echo "<tr>
                        <td>$d[Kd_Indikator]:$d[Nm_Indikator]</td>
                        <td>$d[Tolak_Ukur]</td>
                        <td>$d[Target_Angka]</td>
                        <td>$d[Target_Uraian]</td>
                    </tr>";
            }
            echo "</tbody>
            </table>";
    }

    /**
     * Updates an existing TaIndikator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Indikator
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Indikator' => $model->Kd_Indikator]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaIndikator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Indikator
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaIndikator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Indikator
     * @return TaIndikator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator)
    {
        if (($model = TaIndikator::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg, 'Kd_Indikator' => $Kd_Indikator])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelData($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Indikator)
    {
        if (($model = TaIndikator::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg, 'Kd_Indikator' => $Kd_Indikator])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
