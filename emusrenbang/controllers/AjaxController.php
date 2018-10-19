<?php

namespace emusrenbang\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RefBidang;
use emusrenbang\models\TaSubUnitJab;
use common\models\Ta;
use emusrenbang\models\ProgramNasional;
use emusrenbang\models\PrioritasNasional;
use emusrenbang\models\Nawacita;
use emusrenbang\models\Urusan;
use aemusrenbangpp\models\Misi;
use common\models\RefUnit;
use emusrenbang\models\RefKamusProgram;
use common\models\RefProgram;
use emusrenbang\models\RefKegiatan;
use emusrenbang\models\RefStandardHarga1;
use common\models\RefRek3;
use common\models\RefRek4;
use common\models\RefRek5;
use common\models\RefSsh;
use common\models\RefAsb;
use common\models\RefSubUnit;
use common\models\RefUrusanProv;
use common\models\RefBidangProv;
use common\models\RefUnitProv;
use common\models\RefSubUnitProv;
// use common\models\TaUserDapil;
use eperencanaan\models\TaUserDapil;
use eperencanaan\models\RefDewan;

/**
 * TaSubUnitController implements the CRUD actions for TaSubUnit model.
 */
class AjaxController extends Controller
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

    /*public function actionGetbidang($kdurusan)
    {
        $this->layout='blank';
        $model=RefBidang::find()->where(['Kd_Urusan'=>$kdurusan])->all();
        echo "<option value='0'>Pilih Sektor</option>";

        foreach($model as $d){
            echo "<option value=$d[Kd_Bidang]>$d[Nm_Bidang]</option>";
        }

    }*/
    public function actionModalssh()
    {
    	$this->layout='modalblank';
    	return $this->render('modalssh');

    }

    public function actionStandardharga1(){
    	$this->layout='blank';
    	$Tahun=date('Y');
    	$model=RefStandardHarga1::find()->where(['Tahun'=>$Tahun])->orderBy(['Uraian'=>SORT_ASC])->all();

    	foreach($model as $d){
    		echo "<div><a class='btn btn-primary' id='ssh2'>".$d['Uraian']."</a></div>";
    	}

    }

    public function actionListprogram($urusan, $bidang)
    {
    	$this->layout='blank';
    	$model=RefProgram::find()
    		->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang])
    		->all();
    	echo "<option value='0'>Pilih Program</option>";
    	foreach($model as $d){
    		echo "<option value='$d[Kd_Prog]'>$d[Ket_Program]</option>";
    	}
    }

    public function actionListkegiatan($urusan, $bidang, $kdprog)
    {
    	$this->layout='blank';
    	$model=RefKegiatan::find()
    		->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$kdprog])
    		->all();
    	echo "<option value='0'>Pilih Kegiatan</option>";
    	foreach($model as $d){
    		echo "<option value='$d[Kd_Keg]'>$d[Ket_Kegiatan]</option>";
    	}
    }

    public function actionListkamusprogram()
    {
        $this->layout='blank';
        $model=RefKamusProgram::find()->all();
        echo "<option value='0'>Pilih Program Lainnya</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Program]'>$d[Nm_Program]</option>";
        }
    }

    public function actionListkamusprogrampilihan()
    {
        $this->layout='blank';
        $model=RefKamusProgram::find()->where(['status'=>'2'])->all();
        echo "<option value='0'>Pilih Program Lainnya</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Program]'>$d[Nm_Program]</option>";
        }
    }

    public function actionGetnourutunitjabatan($kdjab)
    {
        $this->layout='blank';
        $identity=Yii::$app->user->identity;
        $kdurusan=$identity->id_urusan;
        $kdbidang=$identity->id_bidang;
        $kdunit=$identity->id_skpd;
        $kdsub=$identity->id_subunit;
        $model=TaSubUnitJab::find()->where(['Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang, 'Kd_Unit'=>$kdunit, 'Kd_Sub'=>$kdsub, 'Kd_Jab'=>$kdjab])->orderBy(['No_Urut'=>SORT_DESC])->one();
        if(isset($model->No_Urut)){
            $no=$model->No_Urut+1;
        }else{
            $no=1;
        }
        echo $no;
        //return $no_urut;
    }

    public function actionGetnouruttatujuan($nomisi)
    {
        $this->layout='blank';
        $ta=new Ta();
        $no=$ta->getNoTaTujuan($nomisi);
        echo $no;
    }

    public function actionGettatujuan($nomisi)
    {
        $this->layout='blank';
        $ta=new Ta();
        $notujuan=$ta->getNoTujuan($nomisi);
        echo "<option>Pilih Tujuan</option>";
            foreach($notujuan as $k=>$v){
                echo "<option value='$k'>$v</option>";
            }
    }

    public function actionGetbidang($kdurusan)
    {
        $this->layout='blank';
        $model=RefBidang::find()->where(['Kd_Urusan'=>$kdurusan])->all();
        echo "<option>Pilih Sektor</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Bidang]'>$d[Nm_Bidang]</option>";
        }
    }

    public function actionGetunit($kdurusan, $kdbidang)
    {
        $this->layout='blank';
        $model=RefUnit::find()->where(['Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang])->all();
        echo "<option>Pilih SKPD</option>";
        foreach($model as $d){
            echo "<option value='$d[Kd_Unit]'>$d[Nm_Unit]</option>";
        }
    }

    public function actionGetidsubunit($kdurusan, $kdbidang)
    {
        $this->layout='blank';
        $model=RefUnit::find()->where(['Kd_Urusan'=>$kdurusan, 'Kd_Bidang'=>$kdbidang])->orderBy(['Kd_Unit' => SORT_DESC])->one();
        echo $model->Kd_Unit+1;
    }

    public function actionGetnotasasaran($nomisi, $notujuan)
    {
        $this->layout='blank';
        $ta=new Ta();
        $nosasaran=$ta->getNoTaSasaran($nomisi, $notujuan);
        echo $nosasaran;
    }

    public function actionGetprioritas($kdurusan, $kdbidang, $kdprog)
    {
        $this->layout='blank';
        $model=ProgramNasional::find()->where(['urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog])->one();
        $id_prioritas=$model->id_prioritas;
        $modelprio=PrioritasNasional::find()->where(['id'=>$id_prioritas])->one();
        echo "<option value='$modelprio->id'>$modelprio->prioritas_nasional</option>";
    }

    public function actionGetnawacita($kdurusan, $kdbidang, $kdprog)
    {
        $this->layout='blank';
        $model=ProgramNasional::find()->where(['urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog])->one();
        $id=$model->id_nawacita;
        $modelnawacita=Nawacita::find()->where(['id'=>$id])->one();
        echo $modelnawacita->nawacita;
    }

    public function actionGetidnawacita($kdurusan, $kdbidang, $kdprog)
    {
        $this->layout='blank';
        $model=ProgramNasional::find()->where(['urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog])->one();
        $id=$model->id_nawacita;
        echo $id;
    }

    public function actionGeturusan($kdurusan, $kdbidang, $kdprog)
    {
        $this->layout='blank';
        $model=ProgramNasional::find()->where(['urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog])->one();
        $id=$model->id_urusan;
        $modelurusan=Urusan::find()->where(['id'=>$id])->one();
        echo "<option value=$id>$modelurusan->urusan</option>";
    }

    public function actionGetmisi($kdurusan, $kdbidang, $kdprog)
    {
        $this->layout='blank';
        $model=ProgramNasional::find()->where(['urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog])->one();
        $id=$model->id_misi;
        $modelmisi=Misi::find()->where(['id'=>$id])->one();
        echo $modelmisi->misi;
    }

    public function actionGetidmisi($kdurusan, $kdbidang, $kdprog)
    {
        $this->layout='blank';
        $model=ProgramNasional::find()->where(['urusan'=>$kdurusan, 'bidang'=>$kdbidang, 'id_program'=>$kdprog])->one();
        $id=$model->id_misi;

        echo $id;
    }

    public function actionGetRek3($Kd_Rek_1, $Kd_Rek_2)
    {
        $data=RefRek3::find()
            ->where(['Kd_Rek_1'=>$Kd_Rek_1, 'Kd_Rek_2'=>$Kd_Rek_2])
            ->all();

        echo "<option value=''>Pilih Rek 3</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Rek_3]>$d[Kd_Rek_3]. $d[Nm_Rek_3]</option>";
        }
    }

    public function actionGetRek4($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3)
    {
        $data=RefRek4::find()
            ->where(['Kd_Rek_1'=>$Kd_Rek_1, 'Kd_Rek_2'=>$Kd_Rek_2, 'Kd_Rek_3'=>$Kd_Rek_3])
            ->all();

        echo "<option value=''>Pilih Rek 4</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Rek_4]>$d[Kd_Rek_4]. $d[Nm_Rek_4]</option>";
        }
    }

    public function actionGetRek5($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4)
    {
        $data=RefRek5::find()
            ->where(['Kd_Rek_1'=>$Kd_Rek_1, 'Kd_Rek_2'=>$Kd_Rek_2, 'Kd_Rek_3'=>$Kd_Rek_3, 'Kd_Rek_4'=>$Kd_Rek_4])
            ->all();

        echo "<option value=''>Pilih Rek 5</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Rek_5]>$d[Kd_Rek_5]. $d[Nm_Rek_5]</option>";
        }
    }

    public function actionModalSshs()
    {
        //$data=[];
        return $this->renderpartial('modal_ssh', [
            //'data' => $data,
        ]);
    }

    public function actionGetSsh($cari)
    {
        $data = RefSsh::find()
                ->where(['LIKE', 'Nama_Barang', $cari])
                ->all();
        return $this->renderpartial('get_ssh', [
            'data' => $data,
        ]);
    }



    public function actionModalAsbs()
    {
        //$data=[];
        return $this->renderpartial('modal_asb', [
            //'data' => $data,
        ]);
    }

    public function actionGetAsb($cari)
    {
        $data = RefAsb::find()
                ->where(['LIKE', 'Jenis_Pekerjaan', $cari])
                ->all();
        return $this->renderpartial('get_asb', [
            'data' => $data,
        ]);
    }

    public function actionGetbidangprog($Kd_Urusan)
    {
        $urusan=RefBidang::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan])
            ->all();
        echo "<option value=0>Pilih Bidang</option>";
        foreach($urusan as $d){
            echo "<option value=$d[Kd_Bidang]>$d[Nm_Bidang]</option>";
        }
        
    }

     public function actionGetunitprog($Kd_Urusan, $Kd_Bidang)
    {
        $unit=RefUnit::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang])
            ->all();
        echo "<option value=0>Pilih Unit</option>";
        foreach($unit as $d){
            echo "<option value=$d[Kd_Unit]>$d[Nm_Unit]</option>";
        }
        
    }

        public function actionGetsubprog($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $subunit=RefSubUnit::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit])
            ->all();
        echo "<option value=0>Pilih Sub Unit</option>";
        foreach($subunit as $d){
            echo "<option value=$d[Kd_Sub]>$d[Nm_Sub_Unit]</option>";
        }
        
    }


    public function actionGetrefprog($Kd_Urusan, $Kd_Bidang)

    {
        $refprog = RefProgram::find()
        ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang])
        ->all();

        echo "<option value=0>Pilih Program</option>";
        foreach($refprog as $d){
            echo "<option value=$d[Kd_Prog]>$d[Ket_Program]</option>";

        }

    }
	//===Ditambah oleh Ripin G
	 public function actionGetrefprog1($Kd_Urusan, $Kd_Bidang,$Kd_Unit,$Kd_Sub_Unit)

    {
        $refprog = RefProgram::find()
        ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub_Unit'=>$Kd_Sub_Unit])
        ->all();

        echo "<option value=0>Pilih Program</option>";
        foreach($refprog as $d){
            echo "<option value=$d[Kd_Prog]>$d[Ket_Program]</option>";

        }

    }

    //======================untuk mengirim ke provinsi============//
    public function actionGetBidangProv($Kd_Urusan)
    {
        $data=RefBidangProv::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan])
            ->all();

        echo "<option value=''>Pilih Bidang</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Bidang]>$d[Nm_Bidang]</option>";
        }
    }

    public function actionGetUnitProv($Kd_Urusan, $Kd_Bidang)
    {
        $data=RefUnitProv::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang])
            ->all();

        echo "<option value=''>Pilih Unit</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Unit]>$d[Nm_Unit]</option>";
        }
    }

    public function actionGetSubUnitProv($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $data=RefSubUnitProv::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit])
            ->all();

        echo "<option value=''>Pilih Sub Unit</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Sub]>$d[Nm_Sub_Unit]</option>";
        }
    }


    public function actionGetuserdapil($Kd_Dapil)
    {
        $dataUser=RefDewan::find()
            ->where(['Kd_Dapil'=>$Kd_Dapil])
            ->all();

        echo "<option value=''>Pilih Dewan</option>";
        foreach($dataUser as $d){
            echo "<option value=$d[Kd_Dewan]>$d[Nm_Dewan]</option>";
        }
        
    }

}
