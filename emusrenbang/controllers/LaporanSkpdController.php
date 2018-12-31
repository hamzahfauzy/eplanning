<?php

namespace emusrenbang\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use emusrenbang\models\TaIndikator;
use common\models\TaSubUnit;
use common\models\TaProgram;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use kartik\mpdf\Pdf;
use emusrenbang\models\TaBelanjaRincSub;
use eperencanaan\models\TaMusrenbang;
use common\models\RefSubUnit;
use common\models\TaRpjmdProgramPrioritas;
use common\models\TaRpjmdPrioritasPembangunanDaerah;
use common\models\TaKegiatanRancanganAwal;

/**
 * LaporanController implements the CRUD actions for Countdown model.
 */
class LaporanSkpdController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className()
            ],
        ];
    }
	
	public function getKota($wil=null) {
      if ($wil) return [
              "Kab" => Yii::$app->pengaturan->Kolom('Nm_Pemda'),
              "Prov" => Yii::$app->pengaturan->nmProvinsi(),
          ];
  		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    public function Posisi() {
        
        $Tahun = Yii::$app->pengaturan->getTahun();
        $unit = 2019; //Yii::$app->levelcomponent->getUnit();
        $Posisi = [
            'Tahun' => $Tahun,
            'Kd_Urusan' => $unit['Kd_Urusan'],
            'Kd_Bidang' => $unit['Kd_Bidang'],
            'Kd_Unit' => $unit['Kd_Unit'],
            'Kd_Sub' => $unit['Kd_Sub_Unit'],
        ];

        return $Posisi;
    }

    public function actionTvic10()
    {
      $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      


      return $this->render('Tvic10', [
         'tahun' => $tahun,
         'subunit' => $TaSubUnit,
         'dataKegiatan'=>$dataKegiatan,
         'dataKeteranganKeg' => $dataKeteranganKeg
    
        ]);
    }

    public function actionCetakTvic10(){
      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

     
      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      

      
      $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('laporan_Tvic10', [
                       'tahun' => $tahun,
                       'subunit' => $TaSubUnit,
                       'dataKegiatan'=>$dataKegiatan,
                       'dataKeteranganKeg' => $dataKeteranganKeg
                       // 'dataUrusBidang'=>$dataUrusBidang
                
                    ]),
                    'options' => [
                        'title' => 'Berita Acara',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                            Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                            Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                            ],
                        'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10'],
                    ]
                ]);
        return $pdf->render();
    }
//Add By Ripin utk ranwal
public function actionTvic10a()
    {
      $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      


      return $this->render('Tvic10a', [
         'tahun' => $tahun,
         'subunit' => $TaSubUnit,
         'dataKegiatan'=>$dataKegiatan,
         'dataKeteranganKeg' => $dataKeteranganKeg
    
        ]);
    }

    public function actionCetakTvic10a(){ 
      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

      $Tahun = 2019;
      $tahun = $Tahun;

     
      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      

      $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('laporan_Tvic10a', [
                       'tahun' => $tahun,
                       'subunit' => $TaSubUnit,
                       'dataKegiatan'=>$dataKegiatan,
                       'dataKeteranganKeg' => $dataKeteranganKeg
                       // 'dataUrusBidang'=>$dataUrusBidang
                
                    ]),
                    'options' => [
                        'title' => 'Berita Acara',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                            Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                            Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                            ],
                        'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10a'],
                    ]
                ]);
        return $pdf->render();
		
		//Batas add
		
	}
//Rancangan Renja
public function actionTvic10b()
    {
      $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = 2019;//Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      


      return $this->render('Tvic10b', [
         'tahun' => $tahun,
         'subunit' => $TaSubUnit,
         'dataKegiatan'=>$dataKegiatan,
         'dataKeteranganKeg' => $dataKeteranganKeg
    
        ]);
    }

    public function actionCetakTvic10b(){
      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

     
      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      
      $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('laporan_Tvic10b', [
                       'tahun' => $tahun,
                       'subunit' => $TaSubUnit,
                       'dataKegiatan'=>$dataKegiatan,
                       'dataKeteranganKeg' => $dataKeteranganKeg
                       // 'dataUrusBidang'=>$dataUrusBidang
                
                    ]),
                    'options' => [
                        'title' => 'Berita Acara',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                            Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                            Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                            ],
                        'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10b'],
                    ]
                ]);
        return $pdf->render();
  
	}
  
  //Rancangan AKhir
  public function actionTvic10c()
    {
      $unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = 2019;//Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      


      return $this->render('Tvic10', [
         'tahun' => $tahun,
         'subunit' => $TaSubUnit,
         'dataKegiatan'=>$dataKegiatan,
         'dataKeteranganKeg' => $dataKeteranganKeg
    
        ]);
    }

    public function actionCetakTvic10c(){
      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

     
      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      

      
      $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('laporan_Tvic10c', [
                       'tahun' => $tahun,
                       'subunit' => $TaSubUnit,
                       'dataKegiatan'=>$dataKegiatan,
                       'dataKeteranganKeg' => $dataKeteranganKeg
                       // 'dataUrusBidang'=>$dataUrusBidang
                
                    ]),
                    'options' => [
                        'title' => 'Berita Acara',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_LANDSCAPE,
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                            Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                            Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                            ],
                        'SetFooter' => ['OPD : '.$TaSubUnit->namaSub->Nm_Sub_Unit.'|Halaman {PAGENO}|Tvic10c'],
                    ]
                ]);
        return $pdf->render();
    }
  
  
  public function actionRekapForum()

  {

    $unit = Yii::$app->levelcomponent->getUnit();
    $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
    
    $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
   
    
    $modelBelanjaRincSub = TaBelanjaRincSub::find()
      ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
      ->andWhere(['Ref_Usulan_Rincian'=>'4'])
      ->orderBy(['Kd_Keg'=>SORT_DESC ])
      ->all();


    return $this->render('rekapforum',[
      'modelBelanja'=>$modelBelanjaRincSub,
      'TaSubUnit'=>$TaSubUnit
      ]);
  }


 public function actionPokir()

  {

  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
   $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'5'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();  


  return $this->render('rekappokir',[
    'modelBelanja' => $modelBelanjaRincSub]);
  }


    public function actionCetakRekappokir()

  {

  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
   $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'5'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();  


    return $this->renderPartial('cetak_RekapPokir', [
      'modelBelanja' => $modelBelanjaRincSub]);
    }
 
  


  public function actionMusrenkota()

  {

  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
  $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'7'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();  

  return $this->render('rekapkot',[
    'modelBelanja' => $modelBelanjaRincSub]);
  }




  public function actionCetakRekapmusrenkot()

  {

  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
  $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'7'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();  

    return $this->renderPartial('cetak_MusrenKota', [
    'modelBelanja' => $modelBelanjaRincSub]);
    }


public function actionSkpd()

  {

  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
   $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'6'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();

  return $this->render('skpd',[
    'modelBelanja' => $modelBelanjaRincSub]);
  }


  public function actionRekapkec()

  {

    $unit = Yii::$app->levelcomponent->getUnit();
    $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
    
    $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
    
    $modelBelanjaRincSub = TaBelanjaRincSub::find()
      ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
      ->andWhere(['Ref_Usulan_Rincian'=>'3'])
      ->orderBy(['Kd_Keg'=>SORT_DESC ])
      ->all();
  
    return $this->render('rekapkec',[
      'modelBelanja'=>$modelBelanjaRincSub,
      'TaSubUnit'=>$TaSubUnit
      ]);
  }



  public function actionCetakRekapkec()

  {

    $unit = Yii::$app->levelcomponent->getUnit();
    $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
    
    $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
    
    $modelBelanjaRincSub = TaBelanjaRincSub::find()
      ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
      ->andWhere(['Ref_Usulan_Rincian'=>'3'])
      ->orderBy(['Kd_Keg'=>SORT_DESC ])
      ->all();


    return $this->renderPartial('cetak_Rekapkec', [
      'modelBelanja'=>$modelBelanjaRincSub,
      'TaSubUnit'=>$TaSubUnit
            ]);
    }



  public function actionCetakRekapForum()

  {

    $unit = Yii::$app->levelcomponent->getUnit();
    $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
    
   $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
      
    $modelBelanjaRincSub = TaBelanjaRincSub::find()
      ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
      ->andWhere(['Ref_Usulan_Rincian'=>'4'])
      ->orderBy(['Kd_Keg'=>SORT_DESC ])
      ->all();


    return $this->renderPartial('cetak_RekapForum', [
                'modelBelanja' => $modelBelanjaRincSub
                ]);
    }

  

   public function actionCetakSkpd()

  {

    $unit = Yii::$app->levelcomponent->getUnit();
    $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
    
    $TaSubUnit = TaSubUnit::find()
      ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
      ->one();
  
    $modelBelanjaRincSub = TaBelanjaRincSub::find()
      ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
      ->andWhere(['Ref_Usulan_Rincian'=>'6'])
      ->orderBy(['Kd_Keg'=>SORT_DESC ])
      ->all();

    return $this->renderPartial('cetak_SKPD', [
                'modelBelanja' => $modelBelanjaRincSub
                ]);
    }


  
  public function actionRekapskpd()

  {


  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
   $TaSubUnit = TaSubUnit::find()
      ->where($PosisiUnit)
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'4'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();

  return $this->render('rekapskpd',[  
    'modelBelanja' => $modelBelanjaRincSub]);
  }



  public function actionCetakRekapskpd()

  {


  $unit = Yii::$app->levelcomponent->getUnit();
  $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
  
   $TaSubUnit = TaSubUnit::find()
      ->where($PosisiUnit)
      ->one();
  
  $modelBelanjaRincSub = TaBelanjaRincSub::find()
    ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
    ->andWhere(['Ref_Usulan_Rincian'=>'4'])
    ->orderBy(['Kd_Keg'=>SORT_DESC ])
    ->all();

  return $this->renderPartial('cetak-rekapskpd',[  
    'modelBelanja' => $modelBelanjaRincSub]);
  }



    public function actionRkpd2()
    {
      //$this->layout='datatable';
        $urusan=Yii::$app->user->identity->id_urusan;
        $bidang=Yii::$app->user->identity->id_bidang;
        $unit=Yii::$app->user->identity->id_skpd;
        $sub=Yii::$app->user->identity->id_subunit;

        $Tahun = 2019;//Yii::$app->pengaturan->getTahun();
        $tahun = $Tahun;

        if(Yii::$app->request->post()){
            $_post=Yii::$app->request->post();
            $tahun=$_post['tahun'];
        }

        $html='<tr><td colspan="10">Data tidak ditemukan</td></tr>';
        $query="SELECT
              ru.Kd_Urusan AS Kd_Urusan,
              rb.Kd_Bidang AS Kd_Bidang,
              ru1.Kd_Unit AS Kd_Unit,
              rp.Kd_Prog AS Kd_Prog,
              rk.Kd_Keg AS Kd_Keg,
              ru.Nm_Urusan,
              rb.Nm_Bidang,
              ru1.Nm_Unit,
              rp.Ket_Program,
              rk.Ket_Kegiatan AS Ket_Kegiatan,
              tk.Lokasi,
              tk.Kd_Sumber AS Kd_Sumber,
              rsd.Nm_Sumber,
              tk.Pagu_Anggaran
              FROM Ref_Kegiatan rk
              INNER JOIN Ref_Urusan ru ON
              ru.Kd_Urusan=rk.Kd_Urusan
              INNER JOIN Ref_Bidang rb ON
              rb.Kd_Urusan=rk.Kd_Urusan AND rb.Kd_Bidang=rk.Kd_Bidang
              INNER JOIN kegiatan_skpd ks
              ON ks.Kd_Urusan =rk.Kd_Urusan AND ks.Kd_Bidang=rk.Kd_Bidang
              AND ks.Kd_Program=rk.Kd_Prog AND ks.Kd_Kegiatan=rk.Kd_Keg
              INNER JOIN Ref_Unit ru1 ON
              ru1.Kd_Urusan=rk.Kd_Urusan AND ru1.Kd_Bidang=rk.Kd_Bidang AND ru1.Kd_Unit=ks.Kd_Unit
              INNER JOIN Ref_Program rp ON
              rp.Kd_Urusan=rk.Kd_Urusan AND rp.Kd_Bidang=rk.Kd_Bidang AND rp.Kd_Prog=rk.Kd_Prog
              LEFT JOIN Ta_Kegiatan tk ON
              tk.Tahun=ks.tahun AND tk.Kd_Urusan=ks.Kd_Urusan AND tk.Kd_Bidang=ks.Kd_Bidang
              AND tk.Kd_Unit=ks.Kd_Unit AND tk.Kd_Prog=ks.Kd_Program AND tk.Kd_Keg=ks.Kd_Kegiatan
              left JOIN Ref_Sumber_Dana rsd ON
              tk.Kd_Sumber=rsd.Kd_Sumber
              WHERE
                ks.tahun=".($tahun-1)." AND
                ks.Kd_Urusan=".$urusan." AND
                ks.Kd_Bidang=".$bidang." AND
                ks.Kd_Unit=".$unit."
              GROUP BY ks.Kd_Kegiatan, ks.Kd_Program
              ORDER BY Kd_Urusan,Kd_Bidang,Kd_Unit,Kd_Prog" ;



        $query=Yii::$app->db->createCommand($query)->queryAll();

        $k_urusan=null;
        $k_bidang=null;
        $k_unit=null;
        $k_program=null;
        foreach ($query as $key => $value) {
            if(!$k_urusan or $k_urusan!=$value['Kd_Urusan'] ){
                $k_urusan = $value['Kd_Urusan'];
                $html="
                    <tr class='tanda'>
                        <td>".$value['Kd_Urusan']."</td>
                        <td>".$value['Nm_Urusan']."</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                ";
            }

            if(!$k_bidang or $k_bidang!=$value['Kd_Bidang'] ){
                $k_bidang = $value['Kd_Bidang'];
                $html.="
                    <tr class='tanda'>
                        <td>".$value['Kd_Urusan'].'.'.$value['Kd_Bidang']."</td>
                        <td>".$value['Nm_Bidang']."</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    ";
            }

            if(!$k_unit or $k_unit!=$value['Kd_Unit'] ){
                $k_unit = $value['Kd_Unit'];
                $html.="
                    <tr class='tanda'>
                        <td>".$value['Kd_Urusan'].'.'.$value['Kd_Bidang'].'.'.$value['Kd_Unit']."</td>
                        <td>".$value['Nm_Unit']."</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    ";
            }

            if(!$k_program or $k_program!=$value['Kd_Prog'] ){
                $k_program = $value['Kd_Prog'];
                $html.="
                    <tr class='tanda'>
                        <td>".$value['Kd_Urusan'].'.'.$value['Kd_Bidang'].'.'.$value['Kd_Unit'].'.'.$value['Kd_Prog']."</td>
                        <td>".$value['Ket_Program']."</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    ";
            }

            $modelInd = TaIndikator::find()->where([
              'Tahun'=>($tahun-1),
              'Kd_Urusan'=>$urusan,
              'Kd_Bidang'=>$bidang,
              'Kd_Unit'=>$unit,
              'Kd_Sub'=>$sub,
              'Kd_Prog'=>$value['Kd_Prog'],
              'Kd_Keg'=>$value['Kd_Keg']
            ])->all();

            $Nmindikator='';
            foreach ($modelInd as $ind) {
                $Nmindikator.=$ind['Tolak_Ukur'];
                $Nmindikator.=' ';
            }

            $html.="<tr>
                        <td>".$value['Kd_Urusan'].'.'.$value['Kd_Bidang'].'.'.$value['Kd_Unit'].'.'.$value['Kd_Prog'].'.'.$value['Kd_Keg']."</td>
                        <td>".$value['Ket_Kegiatan']."</td>
                        <td>".$Nmindikator."</td>
                        <td>".$value['Lokasi']."</td>
                        <td></td>
                        <td>".number_format($value["Pagu_Anggaran"],0,',','.')."</td>
                        <td>".$value['Nm_Sumber']."</td>
                        <td></td>
                    </tr>";
        }

        return $this->render('lapRkpd', [
            "html"  => $html,
            'tahun' => $tahun
            // 'model' => $model,
            // 'ketProgram' => $ketProgram,
            // 'ketKegiatan' => $ketKegiatan,
            // 'id' => $id,
            // 'idkeg' => $idkeg,
            // 'KdProg' => $KdProg
        ]);
    }

    public function actionBeritaAcara() {
        return $this->render('berita-acara');
    }

    public function actionBeritaAcaraCetak() {
      $post = Yii::$app->request->post();
      $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                    'format' => Pdf::FORMAT_FOLIO,
                    'content' => $this->renderPartial('berita-acara-cetak',['nilai' => $post]),
                    'options' => [
                        'title' => 'Berita Acara',
                    //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                    ],
                    'orientation' => Pdf::ORIENT_PORTRAIT,
                    'methods' => [
                        'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                            Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                            Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))
                            ],
                        'SetFooter' => ['|Halaman {PAGENO}|'],
                    ]
                ]);
        return $pdf->render();
    }

    public function actionLaporanRka() {
        $unit = Yii::$app->levelcomponent->getUnit();
        $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
        $data = TaProgram::findAll([
            'Tahun' => $Tahun,
            'Kd_Urusan' => $unit->Kd_Urusan,
            'Kd_Bidang' => $unit->Kd_Bidang,
            'Kd_Unit' => $unit->Kd_Unit,
            'Kd_Sub' => $unit->Kd_Sub_Unit,
        ]);

        return $this->render('laporan-rka',['data' => $data]);
    }

    public function actionLaporanRkaTampil() {
        if ($post = Yii::$app->request->post()) {
            $post = explode(' ', $post['Kd_Keg']);
            $Kegiatan = [
                'Kd_Urusan' => $post[0],
                'Kd_Bidang' => $post[1],
                'Kd_Unit' => $post[2],
                'Kd_Sub' => $post[3],
                'Kd_Prog' => $post[4],
                'Kd_Keg' => $post[5],
            ];
            $data = TaKegiatan::findOne($Kegiatan);
            // echo "<pre>";
            // foreach ($data->getTaBelanjas()->groupBy('Kd_Rek_1')->all() as $key => $value) {
            //     print_r($value->taBelanjaRinc);
            // }
            // die();
            return $this->renderPartial('laporan-rka-tampil', ['data' => $data, 'Kegiatan' => $Kegiatan]);
        }

    }

    public function actionLaporanRkaCetak($program, $kegiatan) {
        $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
        $unit = Yii::$app->levelcomponent->getUnit();
        $Kegiatan = [
            'Tahun' => $Tahun,
            'Kd_Urusan' => $unit->Kd_Urusan,
            'Kd_Bidang' => $unit->Kd_Bidang,
            'Kd_Unit' => $unit->Kd_Unit,
            'Kd_Sub' => $unit->Kd_Sub_Unit,
            'Kd_Prog' => $program,
            'Kd_Keg' => $kegiatan,
        ];
        $data = TaKegiatan::findOne($Kegiatan);
        $pdf = new Pdf([
                      'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                      'format' => Pdf::FORMAT_FOLIO,
                      'content' => $this->renderPartial('laporan-rka-cetak', ['data' => $data, 'Tahun' => $Tahun]),
                      'options' => [
                          'title' => 'Laporan RKA',
                      //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                      ],
                      'orientation' => Pdf::ORIENT_LANDSCAPE,
                      'methods' => [
                          'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                              Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                              Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                      (date('H:i:s'))
                              ],
                          'SetFooter' => ['|Halaman {PAGENO}|'],
                      ]
                  ]);
        return $pdf->render();

    }

    public function actionGetKegiatan() {

        if ($post = Yii::$app->request->post()) {
            $post = explode(' ', $post['Kd_Prog']);
            $program = [
                'Kd_Urusan' => $post[0],
                'Kd_Bidang' => $post[1],
                'Kd_Unit' => $post[2],
                'Kd_Sub' => $post[3],
                'Kd_Prog' => $post[4],
            ];
            $data = TaKegiatan::findAll($program);
            echo "<option value=\"\" disabled selected>Pilih Kegiatan</option>";
            foreach($data as $e){
                echo "<option value=\"".$e['Kd_Urusan']." ".$e['Kd_Bidang']." ".$e['Kd_Unit']." ".$e['Kd_Sub']." ".$e['Kd_Prog']." ".$e['Kd_Keg']."\"> ".$e['Ket_Kegiatan']."</option>";
            }
        }
    }

    public function actionSubUnit() {

      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $data = TaSubUnit::findone($PosisiUnit);

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        return $this->render('sub-unit',[
            'data'=>$data,
            'dataKegiatan'=>$dataKegiatan,
            'dataKeteranganKeg'=>$dataKeteranganKeg,
            'subunit'=>$TaSubUnit]);
    }


    public function actionTvic16()
    {
        $unit = Yii::$app->levelcomponent->getUnit();

        $kelompok = $this->getKota(true);

        $Tahun = 2019; //Yii::$app->pengaturan->getTahun();

        $tahun = $Tahun;

        $TaSubUnit = TaSubUnit::find()
            ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
            ->one();

        $datausulan = TaMusrenbang::find()
                            ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
                            ->all();

        $subunit = RefSubUnit::find()
                            ->where(['Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
                            ->one();                    

        return $this->render('tvic16',[
            'datausulan'=> $datausulan,
            'subunit'=>$subunit,
            'kelompok' => $kelompok,
            'tahun'=>$tahun
            ]);
    }


    public function actionCetakTvic16(){

       $unit = Yii::$app->levelcomponent->getUnit();

       $kelompok = $this->getKota(true);

       $Tahun = 2019; //Yii::$app->pengaturan->getTahun();

       $tahun = $Tahun;

        $TaSubUnit = TaSubUnit::find()
            ->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])
            ->one();

        $datausulan = TaMusrenbang::find()
                            ->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
                            ->all();

        $subunit = RefSubUnit::find()
                            ->where(['Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])
                            ->one();                    
    
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvic16', [
                            'tahun'=>$tahun, 
                            'subunit'=>$subunit,
                            'kelompok' => $kelompok, 
                            'datausulan'=>$datausulan
                        ]),
            'options' => [
                'title' => 'Cetak Tvic16',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

      public function actionTv1c1() {

      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
      $kelompok = $this->getKota(true);

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

      return $this->render('tv1c1', [
              'kelompok' => $kelompok,
              'TaSubUnit'=> $TaSubUnit,
              'dataKegiatan' => $dataKegiatan,
              'dataKeteranganKeg' => $dataKeteranganKeg,
              'tahun' => $tahun
          ]);
    }



    public function actionTv1c1Cetak()
    {

      $unit = Yii::$app->levelcomponent->getUnit();
      $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();
      $kelompok = $this->getKota(true);

      $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
      $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();

      $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

       $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
      
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('tv1c1-cetak',[
                          'kelompok' => $kelompok,
                          'TaSubUnit'=> $TaSubUnit,
                          'dataKegiatan' => $dataKegiatan,
                          'dataKeteranganKeg' => $dataKeteranganKeg,
                          'tahun' => $tahun,
                          ]),
            'options' => [
                'title' => 'Cetak Tvc1c1',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }
   
    public function actionTvc74()
    {
        $subunit = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();

        $data = TaSubUnit::findAll($this->Posisi());

        return $this->render('tvc74',['data' => $data, 'subunit' => $subunit]);
    }

    public function actionCetakTvc74()
    {
        $subunit = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();

        $data = TaSubUnit::findAll($this->Posisi());

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc74', ['data' => $data, 'subunit' => $subunit]),
            'options' => [
                'title' => 'Cetak Tvc74',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTv1c13()
    {
        $subunit  = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();
        $kelompok = $this->getKota(true);
        $Tahun    = 2019; //Yii::$app->pengaturan->getTahun();
        $tahun    = $Tahun;

        return $this->render('tv1c13',[
            'subunit' => $subunit,
            'kelompok' => $kelompok,
            'tahun' => $tahun,
            ]);
    }

    public function actionCetakTv1c13()
    {
        $subunit  = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();
        $kelompok = $this->getKota(true);
        $Tahun    = 2019; //Yii::$app->pengaturan->getTahun();
        $tahun    = $Tahun;

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tv1c13',['subunit'=>$subunit, 'kelompok'=>$kelompok, 'tahun' => $tahun]),
            'options' => [
                'title' => 'Kajian Usulan Program dan Kegiatan',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvc75()
    {
        $subunit = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();

        // $model = TaRpjmdPrioritasPembangunanDaerah::find()
        //         ->orderBy(['No_Prioritas' => SORT_ASC])
        //         ->all();
        $Tahun = 2019; //Yii::$app->pengaturan->getTahun();
        $unit = Yii::$app->levelcomponent->getUnit();
        $model = TaProgram::findAll([
                'Tahun' => $Tahun, 
                'Kd_Urusan'=>$unit->Kd_Urusan, 
                'Kd_Bidang'=>$unit->Kd_Bidang, 
                'Kd_Unit'=>$unit->Kd_Unit, 
                'Kd_Sub'=>$unit->Kd_Sub_Unit]);

        // $model = TaRpjmdPrioritasPembangunanDaerah::find()
        //         ->orderBy(['No_Prioritas' => SORT_ASC])
        //         ->all();

        return $this->render('tvc75', 
                    [
                        'model'=> $model,
                        'subunit' => $subunit,
                    ]);
    }

    public function actionCetakTvc75()
    {
        $subunit = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();

        $unit = Yii::$app->levelcomponent->getUnit();

        $Tahun = 2019; //Yii::$app->pengaturan->getTahun();

        $model = TaProgram::findAll([
                'Tahun' => $Tahun, 
                'Kd_Urusan'=>$unit->Kd_Urusan, 
                'Kd_Bidang'=>$unit->Kd_Bidang, 
                'Kd_Unit'=>$unit->Kd_Unit, 
                'Kd_Sub'=>$unit->Kd_Sub_Unit]);

        // $model = TaRpjmdPrioritasPembangunanDaerah::find()
        //         ->orderBy(['No_Prioritas' => SORT_ASC])
        //         ->all();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-tvc75', ['model'=>$model, 'subunit'=>$subunit]),
            'options' => [
                'title' => 'Prioritas Pembangunan Daerah',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionTvic10Hal52()
    {
        $subunit = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();
        return $this->render('tvic10-hal52',['subunit' => $subunit]);
    }

    public function actionCetakTvic10Hal52()
    {
        $subunit = RefSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('tvic10-hal52',['subunit' => $subunit]),
            'options' => [
                'title' => 'Daftar Kegiatan Lintas SKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionLaporanRkpd() {
        $data = TaSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();
        return $this->render('laporan-rkpd', [
                'data' => $data,
          ]);
    }

    public function actionCetakLaporanRkpd() {
        $data = TaSubUnit::find()->where(Yii::$app->levelcomponent->PosisiUnit())->one();
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => Pdf::FORMAT_A4,
            'content' => $this->renderPartial('cetak-laporan-rkpd', ['data' => $data]),
            'options' => [
                'title' => 'Cetak Laporan RKPD',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' .
                    Yii::$app->zultanggal->ZULgethari(date('N')) . ', ' . (date('j')) . ' ' .
                    Yii::$app->zultanggal->ZULgetbulan(date('n')) . ' ' . (date('Y')) . '/' .
                    (date('H:i:s'))
                ],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

}