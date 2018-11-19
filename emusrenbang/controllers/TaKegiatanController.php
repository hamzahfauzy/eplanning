<?php

namespace emusrenbang\controllers;

use Yii;
use app\models\TaKegiatan;
use app\models\TaKegiatanSearch;
use app\models\RefProgram;
use app\models\RefKegiatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Referensi;
use yii\web\UploadedFile;

/**
 * TaKegiatanController implements the CRUD actions for TaKegiatan model.
 */
class TaKegiatanController extends Controller
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
     * Lists all TaKegiatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaKegiatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaKegiatan model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg),
        ]);
    }

    public function actionUraian($kdprog, $kdkeg)
    {
        $tahun=date('Y');
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
        	$urusan=$cookies['urusan']->value;
        	$bidang=$cookies['bidang']->value;
        	$unit=$cookies['skpd']->value;
        	$sub=$cookies['subUnit']->value;
        }else{
        	$urusan=Yii::$app->user->identity->id_urusan;
        	$bidang=Yii::$app->user->identity->id_bidang;
        	$unit=Yii::$app->user->identity->id_skpd;
        	$sub=Yii::$app->user->identity->id_subunit;
        }

        $modelTaKe=new TaKegiatan();
        $ref=new Referensi();

        // TaKegiatan::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg]))
        $modelPro = RefProgram::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$kdprog])->one();
        $modelKeg = RefKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$kdprog, 'Kd_Keg'=>$kdkeg])->one();

        if (Yii::$app->request->post()){

            // var_dump(Yii::$app->request->post());die;

            $models=$this->findModel($tahun, $urusan, $bidang, $unit, $sub, $kdprog, $kdkeg);
            if(!empty($models)){
               $model=$models;
            }else{
                $model=$modelTaKe;
            }

            $model->load(Yii::$app->request->post());
            $model->Tahun=$tahun;
            $model->Kd_Urusan=$urusan;
            $model->Kd_Bidang=$bidang;
            $model->Kd_Prog=$kdprog;
            $model->Kd_Keg=$kdkeg;
            $model->Ket_Kegiatan=$ref->getKegiatanOne($kdkeg);
            $model->Kd_Unit=$unit;
            $model->Kd_Sub=$sub;


            foreach($_POST as $p){
                if(is_array($p)){
                    $ket=isset($p['Keterangan']) ? $p['Keterangan'] : '';
                    $pagu=str_replace('.','',$p['Pagu_Anggaran']);
                    $model->Pagu_Anggaran=$pagu;
                    $model->Keterangan=$ket;
                }
            }

            if(!empty($_FILES['TaKegiatan']['name']['File'])){
                $namefiledata=$_FILES['TaKegiatan']['name']['File'];
                $tmpfiledata=$_FILES['TaKegiatan']['tmp_name']['File'];
                $info=pathinfo($namefiledata);
                $ext=$info['extension'];
                $filed=$model->Tahun.$model->Kd_Urusan.$model->Kd_Bidang.$model->Kd_Prog.$model->Kd_Keg.$model->Kd_Unit.".".$ext;
                copy($tmpfiledata, 'uploads/'.$filed);
                $model->File=$filed;
            }

            $model->save();
        }
        $rowData = $modelTaKe::find()->where([
            'Tahun'=>$tahun,
            'Kd_Urusan'=>$urusan,
            'Kd_Bidang'=>$bidang,
            'Kd_Unit'=>$unit,
            'Kd_Sub'=>$sub,
            'Kd_Prog'=>$kdprog,
            'Kd_Keg'=>$kdkeg
        ])->one();

        return $this->render('newUraian', [
            'ketProgram'    => $modelPro['Ket_Program'],
            'KdProg'        => $modelPro['Kd_Prog'],
            'ketKegiatan'   => $modelKeg['Ket_Kegiatan'],
            'KdKeg'         => $modelKeg['Kd_Keg'],
            'rowData'       => $rowData,
            'model'         => $modelTaKe
        ]);
    }

    /**
     * Creates a new TaKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($kdurusan, $kdbidang, $kdprog, $kdkeg)
    {
     	$this->layout="modal";
        $ref=new Referensi();

        $model = new TaKegiatan();
        $user=Yii::$app->user->identity;

        $model->Tahun           = date('Y');
        $model->Kd_Urusan       = $kdurusan;
        $model->Kd_Bidang       = $kdbidang;
        $model->Kd_Prog         = $kdprog;
        $model->Kd_Keg          = $kdkeg;
        $model->Ket_Kegiatan    = $ref->getKegiatanOne($kdkeg);
        $model->Kd_Unit         = $user->id_skpd;
        $model->Kd_Sub          = $user->id_subunit;


       $models=$this->findModel($model->Tahun, $model->Kd_Urusan, $model->Kd_Bidang, $model->Kd_Unit, $model->Kd_Sub, $model->Kd_Prog, $model->Kd_Keg);
       if(!empty($models)){
           $model=$models;
        }

        if ($model->load(Yii::$app->request->post())){
            foreach($_POST as $p){
                if(is_array($p)){
                    $pagu=str_replace('.','',$p['Pagu_Anggaran']);
                    $model->Pagu_Anggaran=$pagu;
                }
            }
         if(!empty($_FILES['TaKegiatan']['name']['filedata'])){
         $namefiledata=$_FILES['TaKegiatan']['name']['filedata'];
         $tmpfiledata=$_FILES['TaKegiatan']['tmp_name']['filedata'];
         $info=pathinfo($namefiledata);
         $ext=$info['extension'];
         $filed=$model->Tahun.$model->Kd_Urusan.$model->Kd_Bidang.$model->Kd_Prog.$model->Kd_Keg.$model->Kd_Unit.".".$ext;
        copy($tmpfiledata, 'uploads/'.$filed);
        }
        //$model->filedata->saveAs('uploads/' . $model->filedata->baseName . '.' . $model->filedata->extension);

        if($model->save()) {
            return $this->redirect(['kegiatan-skpd/create',  'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaKegiatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */

    public function actionListkegiatan($kdurusan, $kdbidang, $kdprog, $kdkeg)
    {
        $this->layout="blank";
        $kdunit=Yii::$app->user->identity->id_skpd;
        $kdsub=Yii::$app->user->identity->id_subunit;
        $tahun=date('Y');
        $model=TaKegiatan::find()->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang, 'Kd_Unit'=>$kdunit, 'Kd_Sub'=>$kdsub, 'Kd_Prog'=>$kdprog, 'Kd_Keg'=>$kdkeg])->all();
        echo "<h3>Uraian Kegiatan</h3>";
        echo "<table class='table table-bordered'>
            <thead>
                <th>Ket Kegiatan</th>
                <th>Lokasi</th>
                <th>Kelompok Sasaran</th>
                <th>Status Kegiatan</th>
                <th>Pagu Anggaran</th>
                <th>Waktu Pelaksanaan</th>
                <th>File Pendukung</th>
            </thead>
            <tbody>";
            foreach($model as $d){
            echo "<tr>
                        <td>$d[Ket_Kegiatan]</td>
                        <td>$d[Lokasi]</td>
                        <td>$d[Kelompok_Sasaran]</td>
                        <td>$d[Status_Kegiatan]</td>
                        <td style='text-align:right'>".number_format($d['Pagu_Anggaran'])."</td>
                        <td>$d[Waktu_Pelaksanaan]</td>
                        <td><a href='uploads/$tahun$kdurusan$kdbidang$kdprog$kdkeg$kdunit.pdf'>File</td>
                    </tr>";
            }
            echo "</tbody>
            </table>";

    }

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
     * Deletes an existing TaKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return TaKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg)
    {
        if (($model = TaKegiatan::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            return false;
        }
    }
}
