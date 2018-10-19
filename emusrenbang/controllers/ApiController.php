<?php

namespace emusrenbang\controllers;

use yii\helpers\Json;
use emusrenbang\models\TaHasil;
use common\models\TaProgram;
use common\models\TaKegiatan;
use emusrenbang\models\TaBelanja;
use emusrenbang\models\TaBelanjaRinc;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaIndikator;
use emusrenbang\models\TaFungsi;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\TaMisi;
use common\models\TaTujuan;
use common\models\TaSasaran;
use common\models\RefFungsi;
use common\models\TaTupok;
use common\models\RefTahapan;
use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\RefSsh3;
use common\models\RefSsh4;
use common\models\RefSsh5;
use common\models\RefSsh;
use common\models\RefHspk;
use common\models\RefHspk1;
use common\models\RefHspk2;
use common\models\RefHspk3;
use common\models\RefAsb1;
use common\models\RefAsb2;
use common\models\RefAsb3;
use common\models\RefAsb4;
use common\models\RefAsb;
use common\models\TaSshHspk;
use common\models\TaHspkAsb;

use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use yii\data\ActiveDataProvider;


class ApiController extends ActiveController
{
    
    public $modelClass = 'TaHasil';
    
    public function actions() {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create'], $actions['update'], $actions['view'], $actions['index']);

        // customize the data provider preparation with the "prepareDataProvider()" method
        //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }
    
    public function actionIndex()
    {
        //return $this->render('index');
    }

    public function actionTaHasil($tahapan)
    {
    	//echo 'asdf';
      $tahapan = RefTahapan::findOne(['Uraian' => $tahapan]);
      $id_tahapan = $tahapan->Kd_Tahapan;
      // echo $id_tahapan;
      // die();

     
      return new ActiveDataProvider([
            'query' => TaHasil::find()->where(['Kd_Tahapan' => $id_tahapan]),
            'pagination' => [
                    'pageSize' => 1000,
            ],
	]);

    	
    }

    public function actionTaProgram()
    {
    	//echo 'asdf';
    	$isi_data = TaProgram::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaKegiatan()
    {
    	//echo 'asdf';
    	$isi_data = TaKegiatan::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaBelanja()
    {
    	//echo 'asdf';
    	$isi_data = TaBelanja::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaBelanjaRinc()
    {
    	//echo 'asdf';
    	$isi_data = TaBelanjaRinc::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaBelanjaRincSub()
    {
    	//echo 'asdf';
    	$isi_data = TaBelanjaRincSub::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionRefUrusan()
    {
    	//echo 'asdf';
    	$isi_data = RefUrusan::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionRefBidang()
    {
    	//echo 'asdf';
    	$isi_data = RefBidang::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionRefUnit()
    {
    	//echo 'asdf';
    	$isi_data = RefUnit::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionRefSubUnit()
    {
    	//echo 'asdf';
    	$isi_data = RefSubUnit::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaMisi()
    {
    	//echo 'asdf';
    	$isi_data = TaMisi::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaTujuan()
    {
    	//echo 'asdf';
    	$isi_data = TaTujuan::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaSasaran()
    {
    	//echo 'asdf';
    	$isi_data = TaSasaran::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionRefFungsi()
    {
    	//echo 'asdf';
    	$isi_data = RefFungsi::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaTupok()
    {
    	//echo 'asdf';
    	$isi_data = TaTupok::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaIndikator()
    {
    	//echo 'asdf';
    	$isi_data = TaIndikator::find()->all();

    	$data = Json::encode($isi_data);
      return $this->renderpartial('index',[
      	'data' => $data,
      ]);
    }

    public function actionTaFungsi()
    {
      //echo 'asdf';
      $isi_data = TaFungsi::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }
/*
    public function actionTaFungsi()
    {
      //echo 'asdf';
      $isi_data = TaFungsi::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionTaFungsi()
    {
      //echo 'asdf';
      $isi_data = RefSsh::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    } */
    //========================================//
    public function actionRefSsh1()
    {
      //echo 'asdf';
      $isi_data = RefSsh1::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefSsh2()
    {
      //echo 'asdf';
      $isi_data = RefSsh2::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefSsh3()
    {
      //echo 'asdf';
      $isi_data = RefSsh3::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefSsh4()
    {
      //echo 'asdf';
      $isi_data = RefSsh4::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefSsh5()
    {
      //echo 'asdf';
      $isi_data = RefSsh5::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefSsh()
    {
      //echo 'asdf';
      $isi_data = RefSsh::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }
    //========================================//
    public function actionRefHspk1()
    {
      //echo 'asdf';
      $isi_data = RefHspk1::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefHspk2()
    {
      //echo 'asdf';
      $isi_data = RefHspk2::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefHspk3()
    {
      //echo 'asdf';
      $isi_data = RefHspk3::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefHspk()
    {
      //echo 'asdf';
      $isi_data = RefHspk::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }
    //========================================//
    public function actionRefAsb1()
    {
      //echo 'asdf';
      $isi_data = RefAsb1::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefAsb2()
    {
      //echo 'asdf';
      $isi_data = RefAsb2::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefAsb3()
    {
      //echo 'asdf';
      $isi_data = RefAsb3::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefAsb4()
    {
      //echo 'asdf';
      $isi_data = RefAsb4::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionRefAsb()
    {
      //echo 'asdf';
      $isi_data = RefAsb::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionTaSshHspk()
    {
      //echo 'asdf';
      $isi_data = TaSshHspk::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

    public function actionTaHspkAsb()
    {
      //echo 'asdf';
      $isi_data = TaHspkAsb::find()->all();

      $data = Json::encode($isi_data);
      return $this->renderpartial('index',[
        'data' => $data,
      ]);
    }

}
