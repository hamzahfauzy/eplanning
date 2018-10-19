<?php

namespace satuanharga\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\RefBidang;
use app\models\TaSubUnitJab;
use common\models\Ta;
use app\models\ProgramNasional;
use app\models\PrioritasNasional;
use app\models\Nawacita;
use app\models\Urusan;
use app\models\Misi;
use app\models\RefUnit;
use app\models\RefKamusProgram;
use common\models\RefRekAset1;
use common\models\RefRekAset2;
use common\models\RefRekAset3;
use common\models\RefRekAset4;
use common\models\RefRekAset5;
use common\models\RefStandardHarga1;
use common\models\RefStandardHarga2;
use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\RefSsh3;
use common\models\RefSsh4;
use common\models\RefSsh5;
use common\models\RefSsh;
use common\models\RefHspk1;
use common\models\RefHspk2;
use common\models\RefHspk3;
use common\models\RefHspk;
use common\models\RefAsb1;
use common\models\RefAsb2;
use common\models\RefAsb3;
use common\models\RefAsb4;
use common\models\RefAsb;
use common\models\TaHspkAsb;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;
use yii\helpers\Json;
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


    public function actionGetaset2($Kd_Aset1)
    {
        $aset1=RefRekAset2::find()
            ->where(['Kd_Aset1'=>$Kd_Aset1])
            ->all();
        echo "<option value=0>Pilih ASET2</option>";
        foreach($aset1 as $d){
            echo "<option value=$d[Kd_Aset2]>$d[Nm_Aset2]</option>";
        }

    }

    public function actionGetaset3($Kd_Aset1, $Kd_Aset2)
    {
        $aset3=RefRekAset3::find()
            ->where(['Kd_Aset1'=>$Kd_Aset1, 'Kd_Aset2'=>$Kd_Aset2])
            ->all();
        echo "<option value=0>Pilih ASET3</option>";
        foreach($aset3 as $d){
            echo "<option value=$d[Kd_Aset3]>$d[Nm_Aset3]</option>";
        }

    }

public function actionGetaset4($Kd_Aset1, $Kd_Aset2, $Kd_Aset3)
    {
        $aset4=RefRekAset4::find()
            ->where(['Kd_Aset1'=>$Kd_Aset1, 'Kd_Aset2'=>$Kd_Aset2, 'Kd_Aset3'=>$Kd_Aset3])
            ->all();
        echo "<option value=0>Pilih ASET4</option>";
        foreach($aset4 as $d){
            echo "<option value=$d[Kd_Aset4]>$d[Nm_Aset4]</option>";
        }

            }

public function actionGetaset5($Kd_Aset1, $Kd_Aset2, $Kd_Aset3, $Kd_Aset4)
    {
        $aset5=RefRekAset5::find()
            ->where(['Kd_Aset1'=>$Kd_Aset1, 'Kd_Aset2'=>$Kd_Aset2, 'Kd_Aset3'=>$Kd_Aset3, 'Kd_Aset4'=>$Kd_Aset4])
            ->all();
        echo "<option value=0>Pilih ASET5</option>";
        foreach($aset5 as $d){
            echo "<option value=$d[Kd_Aset5]>$d[Nm_Aset5]</option>";
        }

            }
public function actionGetstandard2($Kd_1)
    {
        $standard2=RefStandardHarga2::find()
            ->where(['Kd_1'=>$Kd_1])
            ->all();
        echo "<option value=0>Pilih Kode2</option>";
        foreach($standard2 as $e){
            echo "<option value=$e[Kd_2]>$e[Uraian]</option>";
        }

    }
public function actionGetssh2($Kd_Ssh1)
    {
        $ssh2=RefSsh2::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1])
            ->all();
        echo "<option value=0>Pilih SSH1</option>";
        foreach($ssh2 as $e){
            echo "<option value=$e[Kd_Ssh2]>$e[Kd_Ssh2]. $e[Nm_Ssh2]</option>";
        }

    }
public function actionGetssh3($Kd_Ssh1, $Kd_Ssh2)
    {
        $ssh3=RefSsh3::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2])
            ->all();

        echo "<option value=0>Pilih SSH3</option>";
        foreach($ssh3 as $e){
            echo "<option value=$e[Kd_Ssh3]>$e[Kd_Ssh3]. $e[Nm_Ssh3]</option>";
        }

    }

public function actionGetInfoHspk4($Kd_Hspk1,$Kd_Hspk2,$Kd_Hspk3,$Kd_Hspk4)
    {
        $hspk=RefHspk::find()
            ->where(['Kd_Hspk1'=>$Kd_Hspk1, 'Kd_Hspk2'=>$Kd_Hspk2, 'Kd_Hspk3'=>$Kd_Hspk3, 'Kd_Hspk4'=>$Kd_Hspk4])
            ->one();
        $nama = $hspk->Uraian_Kegiatan;
        $satuan = $hspk->kdSatuan->Uraian;
        $kdsatuan = $hspk->Kd_Satuan;
        $harga = $hspk->Harga;
        echo $nama."|".$kdsatuan."|".$satuan."|".$harga ;
    }

public function actionGetssh4($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3)
    {
        $ssh4=RefSsh4::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3])
            ->all();

        echo "<option value=0>Pilih SSH4</option>";
        foreach($ssh4 as $e){
            echo "<option value=$e[Kd_Ssh4]>$e[Kd_Ssh4]. $e[Nm_Ssh4]</option>";
        }

    }
public function actionGetssh5($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4)
    {
        $ssh5=RefSsh5::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4])
            ->all();

        echo "<option value=0>Pilih SSH5</option>";
        foreach($ssh5 as $e){
            echo "<option value=$e[Kd_Ssh5]>$e[Kd_Ssh5]. $e[Nm_Ssh5]</option>";
        }

    }

    public function actionGetssh6($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5)
    {
        $ssh6=RefSsh::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4, 'Kd_Ssh5'=>$Kd_Ssh5])
            ->all();
         echo "<option value=0>Pilih SSH6</option>";
        foreach($ssh6 as $e){
            echo "<option value=$e[Kd_Ssh6]>$e[Kd_Ssh6]. $e[Nama_Barang]</option>";
        }
    }

    public function actionMaxSsh2($Kd_Ssh1,$Kode1,$Kode2) {
        $max_ssh2=RefSsh2::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1])
                ->max('Kd_Ssh2');
        $Kd_Ssh2 = $max_ssh2 + 1;
        echo ($Kode1 != $Kd_Ssh1) ? $Kd_Ssh2 : $Kode2;
    }

    public function actionMaxSsh3($Kd_Ssh1, $Kd_Ssh2,$Kode1,$Kode2) {
        $max_ssh3=RefSsh3::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2])
                ->max('Kd_Ssh3');
        $Kd_Ssh3 = $max_ssh3 + 1;
        echo ($Kode1 != $Kd_Ssh1.$Kd_Ssh2) ? $Kd_Ssh3 : $Kode2;
    }

    public function actionMaxSsh4($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3,$Kode1,$Kode2) {
        $max_ssh4=RefSsh4::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3])
                ->max('Kd_Ssh4');
        $Kd_Ssh4 = $max_ssh4 + 1;
        echo ($Kode1 != $Kd_Ssh1.$Kd_Ssh2.$Kd_Ssh3) ? $Kd_Ssh4 : $Kode2;
    }

    public function actionMaxSsh5($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4,$Kode1,$Kode2) {
        $max_ssh5=RefSsh5::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4])
                ->max('Kd_Ssh5');
        $Kd_Ssh5 = $max_ssh5 + 1;
        echo ($Kode1 != $Kd_Ssh1.$Kd_Ssh2.$Kd_Ssh3.$Kd_Ssh4) ? $Kd_Ssh5 : $Kode2;
    }

    public function actionMaxSsh6($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5,$Kode1,$Kode2) {
        $max_ssh6=RefSsh::find()
                ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4, 'Kd_Ssh5'=>$Kd_Ssh5])
                ->max('Kd_Ssh6');
        $Kd_Ssh6 = $max_ssh6 + 1;
        echo ($Kode1 != $Kd_Ssh1.$Kd_Ssh2.$Kd_Ssh3.$Kd_Ssh4.$Kd_Ssh5) ? $Kd_Ssh6 : $Kode2;
    }

    public function actionGetInfoSsh6($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
        $ssh=RefSsh::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4, 'Kd_Ssh5'=>$Kd_Ssh5, 'Kd_Ssh6'=>$Kd_Ssh6 ])
            ->one();
        $nama = $ssh->Nama_Barang;
        $satuan = $ssh->kdSatuan->Uraian;
        $kdsatuan = $ssh->Kd_Satuan;
        $harga = $ssh->Harga_Satuan;
        echo $nama."|".$kdsatuan."|".$satuan."|".$harga ;
    }

    public function actionGetInfoSshAsb($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
        $ssh=RefSsh::find()
            ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2,  'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4, 'Kd_Ssh5'=>$Kd_Ssh5, 'Kd_Ssh6'=>$Kd_Ssh6 ])
            ->one();
        $nama = $ssh->Nama_Barang;
        $satuan = $ssh->kdSatuan->Uraian;
        $kdsatuan = $ssh->Kd_Satuan;
        $harga = $ssh->Harga_Satuan;
        echo $nama."|".$kdsatuan."|".$satuan."|".$harga ;
    }       


public function actionGethspk2($Kd_Hspk1)
    {
        $hspk2=RefHspk2::find()
            ->where(['Kd_Hspk1'=>$Kd_Hspk1])
            ->all();
        echo "<option value=0>Pilih HSPK2</option>";
        foreach($hspk2 as $e){
            echo "<option value=$e[Kd_Hspk2]>$e[Kd_Hspk2] $e[Nm_Hspk2]</option>";
        }

    }
public function actionGethspk3($Kd_Hspk1, $Kd_Hspk2)
    {
        $hspk3=RefHspk3::find()
            ->where(['Kd_Hspk1'=>$Kd_Hspk1, 'Kd_Hspk2'=>$Kd_Hspk2])
            ->all();

        echo "<option value=0>Pilih HSPK3</option>";
        foreach($hspk3 as $e){
            echo "<option value=$e[Kd_Hspk3]>$e[Kd_Hspk3] $e[Nm_Hspk3]</option>";
        }

    }
public function actionGethspk4($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3)
    {
        $hspk4=RefHspk::find()
            ->where(['Kd_Hspk1'=>$Kd_Hspk1, 'Kd_Hspk2'=>$Kd_Hspk2, 'Kd_Hspk3'=>$Kd_Hspk3])
            ->all();

        echo "<option value=0>Pilih HSPK4</option>";
        foreach($hspk4 as $e){
            echo "<option value=$e[Kd_Hspk4]>$e[Kd_Hspk4] $e[Uraian_Kegiatan]</option>";
        }

    }

    public function actionGetNomorHspk2($Kd_Hspk1, $Kode1, $Kode2) {
        $max_hspk2 = RefHspk2::find()
                ->where(['Kd_Hspk1' => $Kd_Hspk1
                ])
                ->max('Kd_Hspk2');
        $Kd_Hspk2 = $max_hspk2 + 1;
        echo ($Kode1 != $Kd_Hspk1) ? $Kd_Hspk2 : $Kode2;
    }

    public function actionGetNomorHspk3($Kd_Hspk1, $Kd_Hspk2, $Kode1, $Kode2) {
        $max_hspk3 = RefHspk3::find()
                ->where(['Kd_Hspk1' => $Kd_Hspk1,
                    'Kd_Hspk2' => $Kd_Hspk2
                ])
                ->max('Kd_Hspk3');
        $Kd_Hspk3 = $max_hspk3 + 1;
        echo ($Kode1 != $Kd_Hspk1.$Kd_Hspk2) ? $Kd_Hspk3 : $Kode2;
    }
///ASB

public function actionGetasb2($Kd_Asb1)
    {
        $asb2=RefAsb2::find()
            ->where(['Kd_Asb1'=>$Kd_Asb1])
            ->all();
        echo "<option value=0>Pilih Asb2</option>";
        foreach($asb2 as $e){
            echo "<option value=$e[Kd_Asb2]>$e[Nm_Asb2]</option>";
        }

    }


public function actionMaxAsb2($Kd_Asb1, $Kode1, $Kode2)
    {
        $max_asb2 = RefAsb2::find()
                ->where(['Kd_Asb1' => $Kd_Asb1,
                ])
                ->max('Kd_Asb2');
        $Kd_Asb2 = $max_asb2 + 1;
        echo ($Kode1 != $Kd_Asb1) ? $Kd_Asb2 : $Kode2;

    }

public function actionGetasb3($Kd_Asb1, $Kd_Asb2)
    {
        $asb3=RefAsb3::find()
            ->where(['Kd_Asb1'=>$Kd_Asb1, 'Kd_Asb2'=>$Kd_Asb2])
            ->all();

        echo "<option value=0>Pilih Asb3</option>";
        foreach($asb3 as $e){
            echo "<option value=$e[Kd_Asb3]>$e[Nm_Asb3]</option>";
        }

    }

public function actionMaxAsb3($Kd_Asb1, $Kd_Asb2, $Kode1, $Kode2)
    {
        $max_asb3 = RefAsb3::find()
                ->where(['Kd_Asb1' => $Kd_Asb1,
                         'Kd_Asb2' => $Kd_Asb2,
                ])
                ->max('Kd_Asb3');
        $Kd_Asb3 = $max_asb3 + 1;
        echo ($Kode1 != $Kd_Asb1.$Kd_Asb2) ? $Kd_Asb3 : $Kode2;

    }

public function actionGetasb4($Kd_Asb1, $Kd_Asb2, $Kd_Asb3)
    {
        $asb4=RefAsb4::find()
            ->where(['Kd_Asb1'=>$Kd_Asb1, 'Kd_Asb2'=>$Kd_Asb2,  'Kd_Asb3'=>$Kd_Asb3])
            ->all();

        echo "<option value=0>Pilih Asb4</option>";
        foreach($asb4 as $e){
            echo "<option value=$e[Kd_Asb4]>$e[Nm_Asb4]</option>";
        }

    }

public function actionMaxAsb4($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kode1, $Kode2)
    {
        $max_asb4 = RefAsb4::find()
                ->where(['Kd_Asb1' => $Kd_Asb1,
                         'Kd_Asb2' => $Kd_Asb2,
                         'Kd_Asb3' => $Kd_Asb3,
                ])
                ->max('Kd_Asb4');
        $Kd_Asb4 = $max_asb4 + 1;
        echo ($Kode1 != $Kd_Asb1.$Kd_Asb2.$Kd_Asb3) ? $Kd_Asb4 : $Kode2;

    }

    public function actionGetasb5($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4)
    {
        $asb5=RefAsb::find()
            ->where(['Kd_Asb1'=>$Kd_Asb1, 'Kd_Asb2'=>$Kd_Asb2, 'Kd_Asb3'=>$Kd_Asb3, 'Kd_Asb4'=>$Kd_Asb4])
            ->all();

        echo "<option value=0>Pilih Asb5</option>";
        foreach($asb5 as $e){
            echo "<option value=$e[Kd_Asb5]>$e[Jenis_Pekerjaan]</option>";
        }

    }

public function actionMaxAsb5($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kode1, $Kode2)
    {
        $max_asb5 = RefAsb::find()
                ->where(['Kd_Asb1' => $Kd_Asb1,
                         'Kd_Asb2' => $Kd_Asb2,
                         'Kd_Asb3' => $Kd_Asb3,
                         'Kd_Asb4' => $Kd_Asb4,
                ])
                ->max('Kd_Asb5');
        $Kd_Asb5 = $max_asb5 + 1;
        echo ($Kode1 != $Kd_Asb1.$Kd_Asb2.$Kd_Asb3.$Kd_Asb4) ? $Kd_Asb5 : $Kode2;

    }

    public function actionGetInfoAsb($Kd_Asb1, $Kd_Asb2, $Kd_Asb3, $Kd_Asb4, $Kd_Asb5)
    {

        $asb=RefAsb::find()
            ->where(['Kd_Asb1'=>$Kd_Asb1, 'Kd_Asb2'=>$Kd_Asb2, 'Kd_Asb3'=>$Kd_Asb3, 'Kd_Asb4'=>$Kd_Asb4, 'Kd_Asb5'=>$Kd_Asb5 ])
            ->one();

        $nama = $asb->Jenis_Pekerjaan;
        $satuan = $asb->kdSatuan->Uraian;
        $kdsatuan = $asb->Kd_Satuan;
        $harga = $asb->Harga;
        echo $nama."|".$kdsatuan."|".$satuan."|".$harga ;
    }     

    public function actionGetssh($Asal)
    {
        // $this->layout="blank";
        $dataSH = RefSsh1::find()->all();
        echo "<option value=0>Pilih SSH1</option>";
        foreach($dataSH as $e){
            echo "<option value=$e[Kd_Ssh1]>$e[Nm_Ssh1]</option>";
        }

    }

       public function actionGethspk($Asal)
    {
         $dataSH = RefHspk1::find()->all();
        echo "<option value=0>Pilih HSPK1</option>";
        foreach($dataSH as $e){
            echo "<option value=$e[Kd_Hspk1]>$e[Nm_Hspk1]</option>";
        }
    }

        public function actionGethargassh($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
         $dataHarga = RefSsh::find()
         ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2, 'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4,'Kd_Ssh5'=>$Kd_Ssh5, 'Kd_Ssh6'=>$Kd_Ssh6])
            ->all();

        foreach($dataHarga as $e){
              echo "<option value=$e[Harga_Satuan]>$e[Harga_Satuan]</option>";
        }
    }


    public function actionGetsatuanssh($Kd_Ssh1, $Kd_Ssh2, $Kd_Ssh3, $Kd_Ssh4, $Kd_Ssh5, $Kd_Ssh6)
    {
         $dataKdsatuan = RefSsh::find()
         ->where(['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2, 'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4,'Kd_Ssh5'=>$Kd_Ssh5, 'Kd_Ssh6'=>$Kd_Ssh6])
            ->all();


        foreach($dataKdsatuan as $e){
              echo "<option value=$e[Kd_Satuan]>$e[Kd_Satuan]</option>";
    }
    }

       public function actionGetInfoHspkAsb($Kd_Hspk1, $Kd_Hspk2, $Kd_Hspk3, $Kd_Hspk4 )
    {

         $hspk=RefHspk::find()
            ->where(['Kd_Hspk1'=>$Kd_Hspk1, 'Kd_Hspk2'=>$Kd_Hspk2, 'Kd_Hspk3'=>$Kd_Hspk3, 'Kd_Hspk4'=>$Kd_Hspk4])
            ->one();

        $nama = $hspk->Uraian_Kegiatan;
        $satuan = $hspk->kdSatuan->Uraian;
        $kdsatuan = $hspk->Kd_Satuan;
        $harga = $hspk->Harga;
        echo $nama."|".$kdsatuan."|".$satuan."|".$harga ;
    }       

    //-----------Cookie ASB ---------------//

    public function actionSetCookie() {
        $request = Yii::$app->request;
        //$this->actionResetCookie();
        $mod = $request->post('DynamicModel');
        $Asal = $mod['Asal'];
        $Kategori_Pekerjaan = $mod['Kategori_Pekerjaan'];
        $Kategori_Pekerjaan_Nama = $request->post('Kategori_Pekerjaan_Nama');
        $Kd1 = $request->post('kd1');
        $Kd2 = $request->post('kd2');
        $Kd3 = $request->post('kd3');
        $Kd4 = $request->post('kd4');
        $Kd5 = $request->post('kd5');
        $Kd6 = $request->post('kd6');
        $Satuan = $request->post('Satuan');
        $Harga_Satuan = $request->post('Harga_Satuan');
        $Koefisien = $request->post('Koefisien');
        $Harga = $request->post('Harga');
        $Uraian = $request->post('Uraian');
        $Kd_Satuan = $request->post('Kd_Satuan');

        $key = $Asal.$Kd1.$Kd2.$Kd3.$Kd4.$Kd5.$Kd6;

        $data = $this->dataCookie('asb');

        $data[$key]['Kd1'] = $Kd1;
        $data[$key]['Kd2'] = $Kd2;
        $data[$key]['Kd3'] = $Kd3;
        $data[$key]['Kd4'] = $Kd4;
        $data[$key]['Kd5'] = $Kd5;
        $data[$key]['Kd6'] = $Kd6;
        $data[$key]['Asal'] = $Asal;
        $data[$key]['Kategori_Pekerjaan'] = $Kategori_Pekerjaan;
        $data[$key]['Nama_Pekerjaan'] = $Kategori_Pekerjaan_Nama;
        $data[$key]['Satuan'] = $Satuan;
        $data[$key]['Harga_Satuan'] = $Harga_Satuan;
        $data[$key]['Koefisien'] = $Koefisien;
        $data[$key]['Harga'] = $Harga;
        $data[$key]['Uraian'] = $Uraian;
        $data[$key]['Kd_Satuan'] = $Kd_Satuan;

        $this->isiCookie($data, 'asb');

        echo "Berhasil";
    }

    public function isiCookie($data, $nama) {
        $isi = Json::encode($data); //mengubah data array ke jason

        $cookies = Yii::$app->response->cookies;
        //membuat cookie
        $cookies->add(new Cookie([
            'name' => $nama,
            'value' => $isi,
            'expire' => time() + 86400 * 365,
        ]));
    }

    public function dataCookie($nama) {
        $cookies = Yii::$app->request->cookies;
        $isi = $cookies[$nama];
        $data = Json::decode($isi);

        return $data;
    }

    public function actionGetCookie() {
        $data = $this->dataCookie('asb');

        return $this->renderpartial('get_cookie_asb', [
                    'data' => $data,
        ]);
    }

    public function actionResetCookie() {
        $data = $this->dataCookie('asb');
        $data=[];
        $this->isiCookie($data, 'asb');
    }

    public function actionDelCookie($key, $kdasb1, $kdasb2, $kdasb3, $kdasb4, $kdasb5, $hspkssh1, $hspkssh2, $hspkssh3, $hspkssh4, $ssh5, $ssh6) {


        //$query = 'Kd_Asb1'=>25, 'Kd_Asb2'=>1, 'Kd_Asb3'=>1, 'Kd_Asb4'=>2, 'Kd_Asb5'=>5, 'Kd_Hspk_Ssh1'=>99, 'Kd_Hspk_Ssh2'=>1, 'Kd_Hspk_Ssh3'=>1, 'Kd_Hspk_Ssh4'=>1, 'Kd_Ssh5'=>0, 'Kd_Ssh6'=>0, 'Koefisien'=>0.02;
        //$model = TaHspkAsb::findOne(25,1,1,2,5,99,1,1,1,0,0,2);
		//TaHspkAsb::model()->deleteByPk(array('Kd_Asb1'=>25, 'Kd_Asb2'=>1, 'Kd_Asb3'=>1, 'Kd_Asb4'=>2, 'Kd_Asb5'=>5, 'Kd_Hspk_Ssh1'=>99, 'Kd_Hspk_Ssh2'=>1, 'Kd_Hspk_Ssh3'=>1, 'Kd_Hspk_Ssh4'=>1, 'Kd_Ssh5'=>0, 'Kd_Ssh6'=>0));
		//print_r($model);
		
		$query = "DELETE FROM Ta_Hspk_Asb WHERE Kd_Asb1 = $kdasb1 AND 
												Kd_Asb2 = $kdasb2 AND
												Kd_Asb3 = $kdasb3 AND 
												Kd_Asb4 = $kdasb4 AND
												Kd_Asb5 = $kdasb5 AND
												Kd_Hspk_Ssh1 = $hspkssh1 AND 
												Kd_Hspk_Ssh2 = $hspkssh2 AND 
												Kd_Hspk_Ssh3 = $hspkssh3 AND
												Kd_Hspk_Ssh4 = $hspkssh4 AND 
												Kd_Ssh5 = $ssh5 AND
												Kd_Ssh6 = $ssh6";
												
		Yii::$app->db->createCommand($query)->execute();
		
        $data = $this->dataCookie('asb');
        unset($data[$key]);
        $this->isiCookie($data, 'asb');
    }

}
