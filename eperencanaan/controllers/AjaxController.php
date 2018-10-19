<?php
/**
 * Dengan Nama Allah yang Maha Pengasih Lagi Maha Penyayang
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * 
 * Team Developer :
 * Irwan Daniel         -> irwandaniel@gmail.com
 * Fadri firamassyah    -> 
 *
 *
 * @category   Web Aplikasi
 * @package    Sistem e-Planning
 * @copyright  Copyright (c) 2017 
 * @license    Tidak Geratis dan Tidak untuk Di Perjual Belikan
 * @version    ##0.7##, ##18 Maret 2017##
 *  
 * 
 */
namespace eperencanaan\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\RefBidang;
use common\models\RefProgram;
use common\models\RefKegiatan;
use common\models\RefJenisUsulan;
use common\models\TaKalender;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use eperencanaan\models\TaForumLingkungan;
use common\models\TaSubUnit;
use common\models\RefSubUnit;
use common\models\RefSsh1;
use common\models\RefHspk1;
use common\models\RefAsb1;
use common\models\RefKabupaten;

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
    
     public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec'],
            'Kd_Kel' => $data['Kd_Kel'],
            'Kd_Urut_Kel' => $data['Kd_Urut_Kel'],
            //'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $ZULarray;
    }
	
	public function arraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec'],
            //'Kd_Kel' => $data['Kd_Kel'],
            //'Kd_Urut_Kel' => $data['Kd_Urut_Kel'],
            //'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $ZULarray;
    }

    public function actionGetbidang($Kd_Urusan)
    {
        $data=RefBidang::find()
            ->where(['Kd_Urusan'=>$Kd_Urusan])
            ->all();
        echo "<option value=0>Pilih Bidang</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Bidang]>$d[Nm_Bidang]</option>";
        }
    }

    public function actionGetprogram($Kd_Bidang,$Kd_Urusan)
    {
        $data=RefProgram::find()
            ->where(['Kd_Bidang'=>$Kd_Bidang, 'Kd_Urusan'=>$Kd_Urusan, ])
            ->all();
        echo "<option value=0>Pilih Bidang</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Prog]>$d[Ket_Program]</option>";
        }
    }

    public function actionGetkegiatan($Kd_Prog,$Kd_Bidang,$Kd_Urusan)
    {
        $data=RefKegiatan::find()
            ->where(['Kd_Prog'=>$Kd_Prog,'Kd_Bidang'=>$Kd_Bidang, 'Kd_Urusan'=>$Kd_Urusan, ])
            ->all();
        echo "<option value=0>Pilih Bidang</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Keg]>$d[Ket_Kegiatan]</option>";
        }
    }

    public function actionGetjenisusulan($Kd_Keg,$Kd_Prog,$Kd_Bidang,$Kd_Urusan)
    {
        $data=RefJenisUsulan::find()
            ->where(['Kd_Keg'=>$Kd_Keg,'Kd_Prog'=>$Kd_Prog,'Kd_Bidang'=>$Kd_Bidang, 'Kd_Urusan'=>$Kd_Urusan, ])
            ->all();
        echo "<option value=0>Pilih Jenis Usulan</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Klasifikasi]>$d[Nm_Jenis_Usulan]</option>";
        }
    }

    public function actionGetkalender()
    {

        $model = TaKalender::find()->all();
        // $color=array('#8775a7','#44b6ae','#e35b5a','#578ebe');
        $color=array('#85d6de','#f2b85c','#97dc3c','#578ebe');
        $result=array();
        $i=0;
        foreach ($model as $key => $value) {
            $tmp=array();
            $dateS=new \ DateTime($value->Waktu_Mulai);
            $dateE=new \ DateTime($value->Waktu_Selesai);
            $tmp['title']=$value->Keterangan;
            $tmp['start']=$dateS->format('Y-m-d');
            $tmp['end']=$dateE->format('Y-m-d');
            if($i>=count($color)){
                $i=0;
            }
            $tmp['color']=$color[$i];
            $result[]=$tmp;
            $i++;
        }

        return json_encode($result);
    }

    public function actionGetKelu($Kd_Kec)
    {
        $data=RefKelurahan::find()
            ->where(['Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec'=>$Kd_Kec])
            ->all();
        echo "<option value=0>Pilih Kelurahan</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Urut]>$d[Nm_Kel]</option>";
        }
    }
	
	 public function actionGetkel($Kd_Kec)
    {
        $data=RefKelurahan::find()
            ->where(['Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec'=>$Kd_Kec])
            ->all();
        echo "<option value=0>Pilih Kelurahan</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Urut]>$d[Nm_Kel]</option>";
        }
    }

    public function actionGetling($Kd_Kec, $Kd_Kel)
    {
        $data=RefLingkungan::find()
            ->where(['Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel])
            ->all();
        echo "<option value=0>Pilih Lingkungan</option>";
        foreach($data as $d){
            echo "<option value=$d[Kd_Lingkungan]>$d[Nm_Lingkungan]</option>";
        }
    }
	
	 public function actionGetZulKel($Kd_Kec)
    {
        $data=RefKelurahan::find()
            ->where(['Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec'=>$Kd_Kec])
            ->all();
        echo "<option value=0>Pilih Lingkungan</option>";
        foreach($data as $d){
			$arr = serialize(array('Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec' => $Kd_Kec, 'Kd_Urut_Kel'=>$d["Kd_Urut"], 'Kd_Lingkungan' => $d["Kd_Lingkungan"]));
            echo "<option value=$arr>$d[Nm_Lingkungan]</option>";
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
                    <td>".$d['Jumlah']." ".$d->kdSatuan->Uraian."</td>
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
    
    public function actionZulJalan($value){
        $ZULuser = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        $ZULuser['Kd_Lingkungan'] = $value;
        $items =  \yii\helpers\ArrayHelper::map(\common\models\search\RefJalan::find()
                ->where($ZULuser)
                ->all(),'Kd_Jalan', 'Nm_Jalan');
        return \yii\helpers\Html::renderSelectOptions([], $items);
    }
	
	public function actionDataJalan($value){
        $ZULuser = $this->arraymap(Yii::$app->levelcomponent->getKelompok());
		$value = explode("|",$value);
		$ZULuser['Kd_Kel'] = $value[0];
		$ZULuser['Kd_Urut_Kel'] = $value[1];
        $ZULuser['Kd_Lingkungan'] = $value[2];
        $items =  \yii\helpers\ArrayHelper::map(\common\models\search\RefJalan::find()
                ->where($ZULuser)
                ->all(),'Kd_Jalan', 'Nm_Jalan');
        return \yii\helpers\Html::renderSelectOptions([], $items);
    }
	
	public function actionDataLingkungan($value){
        $ZULuser = $this->arraymap(Yii::$app->levelcomponent->getKelompok());
		$value = explode("|",$value);
        $ZULuser['Kd_Kel'] = $value[0];
        $ZULuser['Kd_Urut_Kel'] = $value[1];
		$kel = \common\models\search\RefLingkungan::find()
                ->where($ZULuser)
                ->all();
		$valkel = [];
		foreach($kel as $rows){
			$valkel[] = ["Kd"=>$rows['Kd_Kel']."|".$rows['Kd_Urut_Kel']."|".$rows['Kd_Lingkungan'],"Nm"=>$rows['Nm_Lingkungan']];
		}
        $items =  \yii\helpers\ArrayHelper::map($valkel,'Kd', 'Nm');
        return \yii\helpers\Html::renderSelectOptions([], $items);
    }

    public function actionGetsubunit($Kd_Unit){

    $sub=RefSubUnit::find()
            ->where(['Kd_Unit'=>$Kd_Unit])
            ->all();

        echo "<option value=0>Pilih Sub</option>";
        foreach($sub as $d){
            echo "<option value=$d[Kd_Sub]>$d[Nm_Sub_Unit]</option>";
        }
    }

    public function actionGetbidangsub($Kd_Unit, $Kd_Sub){

    $bidang=TaSubUnit::find()
            ->where(['Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=> $Kd_Sub ])
            ->all();
        echo "<option value=Pilih Bidang</option>";
        foreach($bidang as $d){
            echo "<option value=$d[Kd_Bidang]>$d[Nm_Pimpinan]</option>";
        }
    }


        public function actionGetssh($Kd_Asal)
    {
        // $this->layout="blank";
        $dataSH = RefSsh1::find()->all();
        echo "<option value=0>Pilih SSH1</option>";
        foreach($dataSH as $e){
            echo "<option value=$e[Kd_Ssh1]>$e[Nm_Ssh1]</option>";
        }

    }

       public function actionGethspk($Kd_Asal)
    {
         $dataSH = RefHspk1::find()->all();
        echo "<option value=0>Pilih HSPK1</option>";
        foreach($dataSH as $e){
            echo "<option value=$e[Kd_Hspk1]>$e[Nm_Hspk1]</option>";
        }
    }


          public function actionGetasb($Kd_Asal)
    {
         $dataSH = RefAsb1::find()->all();
        echo "<option value=0>Pilih ASB1</option>";
        foreach($dataSH as $e){
            echo "<option value=$e[Kd_Asb1]>$e[Nm_Asb1]</option>";
        }
    }

    // public function actionGetbidangsub($Kd_Unit, $Kd_Sub){

    // $bidang=TaSubUnit::find()
    //         ->where(['Kd_Unit'=>$Kd_Unit, 'Kd_Sub'=> $Kd_Sub ])
    //         ->all();
    //     echo "<option value=Pilih Bidang</option>";
    //     foreach($bidang as $d){
    //         echo "<option value=$d[Kd_Bidang]>$d[Kd_Bidang]</option>";
    //     }
    // }


    public function actionGetkab($Kd_Prov)

    {
            $dataKab = RefKabupaten::find()
                    ->where(['Kd_Prov'=>$Kd_Prov])
                    ->all();       
            echo "<option value=0>Pilih Kabupaten</option>";
            foreach ($dataKab as $key) {
                echo "<option value = $key[Kd_Kab]>$key[Nm_Kab]</option>";
            }

    }

}
