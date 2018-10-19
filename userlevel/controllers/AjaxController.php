<?php

namespace userlevel\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefLevel;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use eperencanaan\models\RefDewan;

class AjaxController extends Controller
{
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

    public function actionGetbidang($KdUrusan)
    {
        $this->layout='blank';
        $model=RefBidang::find()->where(['Kd_Urusan'=>$KdUrusan])->all();
        echo "<option>Pilih Bidang</option>";
        foreach($model as $d)
        {
            echo "<option value='$d[Kd_Bidang]'>$d[Nm_Bidang]</option>";
        }
    }

    public function actionGetunit($KdUrusan,$KdBidang)
    {
        $this->layout='blank';
        $model=RefUnit::find()->where(['Kd_Urusan'=>$KdUrusan, 'Kd_Bidang'=>$KdBidang])->all();
        echo "<option>Pilih Unit</option>";
        foreach($model as $d)
        {
            echo "<option value='$d[Kd_Unit]'>$d[Nm_Unit]</option>";
        }

    }

    public function actionGetsubunit($KdUrusan,$KdBidang,$KdUnit)
    {
        $this->layout='blank';
        $model=RefSubUnit::find()->where(['Kd_Urusan'=>$KdUrusan, 'Kd_Bidang'=>$KdBidang, 'Kd_Unit'=>$KdUnit])->all();
        echo "<option>Pilih Sub Unit</option>";
        foreach($model as $d)
        {
            echo "<option value='$d[Kd_Sub]'>$d[Nm_Sub_Unit]</option>";
        }
    }
    
    public function actionSetlevel($jenis){
    	if ($jenis == 1){
			$data = RefLevel::find()->all();
		}else{
			$data = RefLevel::find()->where(['Kd_Level' => 3])->all();
		}
		$idtable = 'Kd_Level';
		$nama = 'Nm_Level';
		$tagOptions = ['prompt' => "=== Select ==="];
		//print_r($data);
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
		
    }
    
    public function actionGetkab($Kd_Prov){
    	$data=RefKabupaten::find()->where(['Kd_Prov'=>$Kd_Prov])->all();
    	$idtable = 'Kd_Kab';
		$nama = 'Nm_Kab';
		$tagOptions = ['prompt' => "Pilih Kabupaten"];
		//print_r($data);
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
    }
    
    public function actionGetkec($Kd_Prov, $Kd_Kab){
    	$data=RefKecamatan::find()->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab])->all();
    	$idtable = 'Kd_Kec';
		$nama = 'Nm_Kec';
		$tagOptions = ['prompt' => "Pilih Kecamatan"];
		//print_r($data);
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
    }
    
    public function actionGetkel($Kd_Kec){
  //   	$config		= Yii::$app->configcomponent;
		// $FdKd_Prov	= $config->FdKd_Prov;
		// $FDKd_Kab	= $config->FDKd_Kab;

        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');
		
    	$data=RefKelurahan::find()->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab, 'Kd_Kec'=>$Kd_Kec])->all();
    	$idtable = 'Kd_Kel';
    	$idtable1 = 'Kd_Urut';
		$nama = 'Nm_Kel';
		$tagOptions = ['prompt' => "Pilih Kelurahan"];
		//print_r($data);
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable1, $nama), $tagOptions);
    }
    
    public function actionGetling($Kd_Kec, $Kd_Urut_Kel)
    {
  //   	$config		= Yii::$app->configcomponent;
		// $FdKd_Prov	= $config->FdKd_Prov;
		// $FDKd_Kab	= $config->FDKd_Kab;
		$Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

    	$data=RefLingkungan::find()->where(['Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab, 
    		'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Urut_Kel])->all();
    	$idtable = 'Kd_Lingkungan';
		$nama = 'Nm_Lingkungan';
		$tagOptions = ['prompt' => "Pilih Lingkungan"];
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
    }

    public function actionGetdewan($Kd_Dapil){
        $data=RefDewan::find()->where(['Kd_Dapil'=>$Kd_Dapil])->all();
        $idtable = 'Kd_Dewan';
        $nama = 'Nm_Dewan';
        $tagOptions = ['prompt' => "Pilih Dewan"];
        //print_r($data);
        return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
    }

}
