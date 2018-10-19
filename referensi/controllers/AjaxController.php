<?php

namespace referensi\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefRek2;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefAnalisaSub;
use common\models\TaSubUnit;
use common\models\TaMisi;
use common\models\TaTujuan;

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

    public function actionGetkab($Kd_Prov)
    {
        $data=RefKabupaten::find()
            ->where(['Kd_Prov' => $Kd_Prov])
            ->all();
        echo "<option value=0>-Pilih Kabupaten-</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Kab]>$d[Nm_Kab]</option>";
        }
    }

    public function actionGetkec($Kd_Prov, $Kd_Kab)
    {
        $data=RefKecamatan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab])
            ->all();
        echo "<option value=0>-Pilih Kecamatan-</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Kec]>$d[Nm_Kec]</option>";
        }
    }

    public function actionGetkel($Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        $data=RefKelurahan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec])
            ->all();
        echo "<option value=0>Pilih Kelurahan</option>";
        foreach($data as $d){
            echo "<option value='$d[Kd_Urut]'>$d[Nm_Kel]</option>";
        }
    }

    public function actionGetkelkode($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel)
    {
        $data=RefKelurahan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut'=>$Kd_Kel])
            ->one();
        echo $data['Kd_Kel'];
    }

    public function actionGetling($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel)
    {
        $data=RefLingkungan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel])
            ->all();
        echo "<option value=0>Pilih Lingkungan</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Lingkungan]>$d[Nm_Lingkungan]</option>";
        }
    }

    public function actionGetusulan($Kd_Kec, $Kd_Kel, $Kd_Ling)
    {
        $data = TaForumLingkungan::find()
            ->where(['Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel, 'Kd_Lingkungan'=>$Kd_Ling])
            ->all();
        $no=0;
        $summary=0;
        foreach($data as $d){
            $no++;
            $summary+=$d['Harga_Total'];
            $total = number_format($d['Harga_Total'], 2, ',', '.');
            echo "
                <tr>
                    <td>".$no.".</td>
                    <td>".$d['Nm_Permasalahan']."</td>
                    <td>".$d['Jenis_Usulan']."</td>
                    <td>".$d['Jumlah']."</td>
                    <td class='rupiah'>".$total."</td>
                </tr>
            ";
        }

        $summary = number_format($summary, 2, ',', '.');
        echo "
        <tr>
            <td></td>
            <td colspan='3'>Total</td>
            <td class='rupiah'>".$summary."</td>
        </tr>
    ";
    }
    
    public function actionBenua(){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefBenua::find()->all(),'Kd_Benua','Nm_Benua');
        return $items;
    }
    
    public function actionBenuaSub($Kd_Benua){
        
        if (Yii::$app->request->isPost){
            $val = Yii::$app->request->post('value');
            $items = \yii\helpers\ArrayHelper::map(\common\models\RefBenuaSub::find()->where(['Kd_Benua' => $val])->all(),'Kd_Benua_Sub','Nm_Benua_Sub');
            return \yii\helpers\Html::renderSelectOptions([], $items);
        }
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefBenuaSub::find()->where(['Kd_Benua' => $Kd_Benua])->all(),'Kd_Benua_Sub','Nm_Benua_Sub');
        return $items;
    }
    
    public function actionProvinsi(){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefProvinsi::find()->all(),'Kd_Prov','Nm_Prov');
        return $items;
    }
    
    public function actionKabupaten($Kd_Prov){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefKabupaten::find()
                ->where(['Kd_Prov'=>$Kd_Prov])->all(),'Kd_Kab','Nm_Kab');
        return $items;
    }
    
    public function actionKecamatan($Kd_Prov, $Kd_Kab){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefKecamatan::find()
                ->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab' => $Kd_Kab])->all(),'Kd_Kec','Nm_Kec');
        return $items;
    }
    
    public function actionKelurahan($Kd_Prov, $Kd_Kab, $Kd_Kec){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefKelurahan::find()
                ->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec])->all(),'Kd_Urut','Nm_Kel');
        return $items;
    }
    
    public function actionLingkungan($Kd_Prov, $Kd_Kab, $Kd_Kec,$Kd_Urut_Kel){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefLingkungan::find()
                ->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec,
                        'Kd_Urut_Kel'=>$Kd_Urut_Kel])->all(),'Kd_Lingkungan','Nm_Lingkungan');
        return $items;
    }


    public function actionUrusan(){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefUrusan::find()->all(),'Kd_Urusan','Nm_Urusan');
        return $items;
    }

public function actionFungsi(){
        $items = \yii\helpers\ArrayHelper::map(\common\models\RefFungsi::find()->all(),'Kd_Fungsi','Nm_Fungsi');
        return $items;
    }

public function actionGetrek2($Kd_Rek_1)
    {
        $rek1=RefRek2::find()
            ->where(['Kd_Rek_1'=>$Kd_Rek_1])
            ->all();
        echo "<option value=0>Pilih Rek 2</option>";
        foreach($rek1 as $d){
            echo "<option value=$d[Kd_Rek_2]>$d[Nm_Rek_2]</option>";
        }
        
    }

public function actionGetbidang($Kd_Urusan)
    {
        $urusan=RefBidang::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan])
            ->all();
        echo "<option value=0>Pilih Bidang</option>";
        foreach($urusan as $d){
            echo "<option value=$d[Kd_Bidang]>$d[Nm_Bidang]</option>";
        }
        
    }
 public function actionGetunit($Kd_Urusan, $Kd_Bidang)
    {
        $unit=RefUnit::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang])
            ->all();
        echo "<option value=0>Pilih Unit</option>";
        foreach($unit as $d){
            echo "<option value=$d[Kd_Unit]>$d[Nm_Unit]</option>";
        }
        
    } 

 public function actionGetsubunit($Kd_Urusan, $Kd_Bidang, $Kd_Unit)
    {
        $sub=TaSubUnit::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit])
            ->all();
        echo "<option value=0>Pilih Sub</option>";
        foreach($sub as $d){
            echo "<option value=$d[Kd_Sub]>$d[Nm_Pimpinan]</option>";
        }
        
    }  
 public function actionGetmisi($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub)
    {

        $misi=TaMisi::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub])
            ->all();
        echo "<option value=0>Pilih Misi</option>";
        foreach($misi as $d){
            echo "<option value=$d[No_Misi]>$d[Ur_Misi]</option>";
        }
        
    }


public function actionGettujuan($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $No_Misi)
    {

        $tujuan=TaTujuan::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=>$Kd_Sub,'No_Misi'=>$No_Misi ])
            ->all();
        echo "<option value=0>Pilih Tujuan</option>";
        foreach($tujuan as $d){
            echo "<option value=$d[No_Tujuan]>$d[Ur_Tujuan]</option>";
        }
    }               
public function actionGetprog($Kd_Urusan, $Kd_Bidang)
    {
        $program=RefProgram::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan, 'Kd_Bidang'=>$Kd_Bidang])
            ->all();
        echo "<option value=0>Pilih Program</option>";
        foreach($program as $d){
            echo "<option value=$d[Kd_Prog]>$d[Ket_Program]</option>";
        }
        
    }  

public function actionGetanalisasub($Kd_Analisa)
    {

        $analisa=RefAnalisaSub::find()
            ->where(['Kd_Analisa'=>$Kd_Analisa])
            ->all();
        echo "<option value=0>Pilih Analisa Sub</option>";
        foreach($analisa as $d){
            echo "<option value=$d[Kd_Analisa_Sub]>$d[Nm_Analisa_Sub]</option>";
        }
        
    }  

}
