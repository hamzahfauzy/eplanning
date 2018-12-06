<?php

namespace eperencanaan\controllers;

use Yii;
use common\models\RefKelurahan;
use common\models\RefRPJMD;
use common\models\RefBidangPembangunan;
use yii\helpers\ArrayHelper;
use common\models\TaMusrenbangKelurahan;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use eperencanaan\models\TaMusrenbang;
use eperencanaan\models\KamusUsulan;
use common\models\RefSubUnit;
use common\models\RefMedia;
use yii\web\UploadedFile;

class TaMusrenbangKecamatanReportController extends \yii\web\Controller {

    public function ZULAsal() {
        $ZULkelompok = \Yii::$app->levelcomponent->getKelompok();
        return [
            'Kd_Prov' => $ZULkelompok->Kd_Prov,
            'Kd_Kab' => $ZULkelompok->Kd_Kab,
            'Kd_Kec' => $ZULkelompok->Kd_Kec,
            // 'Kd_Kel' => $ZULkelompok->Kd_Kel,
            // 'Kd_Urut' => $ZULkelompok->Kd_Urut,
        ];
    }
	
	public function ZULarraymap($data) {
        $ZULarray = [
            'Kd_Prov' => $data['Kd_Prov'],
            'Kd_Kab' => $data['Kd_Kab'],
            'Kd_Kec' => $data['Kd_Kec']
        ];

        return $ZULarray;
    }
	
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}
	

    public function actionIndex() {

        $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
		
		$model = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
		
		$ZULmodel = new \eperencanaan\models\UploadPaskaRembuk();
		if ($ZULmodel->load(Yii::$app->request->post())) {
            $ZULmodel->imageFile = UploadedFile::getInstances($ZULmodel, 'imageFile');
            $ZULmodel->videoFile = UploadedFile::getInstances($ZULmodel, 'videoFile');
            //var_dump($ZULmodel->imageFile);exit;
            if ($ZULmodel->upload()) {
                $id = 0;
                foreach ($ZULmodel->imageFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameImage[$id]]);
                    if ($user == null)
                        continue;
                    $ZULmodel2 = new \eperencanaan\models\TaUsulanKelurahanMedia();
                    //print($user->Kd_Media);exit;
                    $ZULmodel2->Kd_Media = $user->Kd_Media;
                    $ZULmodel2->Kd_Ta_Musrenbang_Kelurahan = $ZULmodel->id;
                    $ZULmodel2->Jenis_Dokumen = "Foto";
                    $ZULmodel2->save(false);
                    $id++;
                }
                $id = 0;
                foreach ($ZULmodel->videoFile as $file) {

                    $user = RefMedia::findOne(['Nm_Media' => $ZULmodel->nameVideo[$id]]);
                    if ($user == null)
                        continue;
                    $ZULmodel2 = new \eperencanaan\models\TaUsulanKelurahanMedia();
                    $ZULmodel2->Kd_Media = $user->Kd_Media;
                    $ZULmodel2->Kd_Ta_Musrenbang_Kelurahan = $ZULmodel->id;
                    $ZULmodel2->Jenis_Dokumen = "Video";
                    $ZULmodel2->save(false);
                    $id++;
                }
            }
        }
		
		$rpjmd = RefRPJMD::find()->all();
		$opd = function($urusan,$bidang){
			
			$model = RefSubUnit::find()->where(["Kd_Urusan"=>$urusan,"Kd_Bidang"=>$bidang,"Kd_Unit"=>1])->one();
			if(count($model))
				return $model->Nm_Sub_Unit;
			else
				return "";
			
		};
		/*
		$opd = function($usulan){
			$usulan = rtrim($usulan);
			$model = KamusUsulan::find()->where(["nama_kamus"=>$usulan])->one();
			//$model = KamusUsulan::find()->where(["LIKE","nama_kamus",$usulan])->one();
			if(count($model)){
				$SKPD = explode("/",$model->SKPD);
				$subunit = RefSubUnit::find()->where(['Kd_Urusan'=>$SKPD[0],'Kd_Bidang'=>$SKPD[1],'Kd_Unit'=>$SKPD[2],'Kd_Sub'=>$SKPD[3]])->one();
				return $subunit->Nm_Sub_Unit;
			}else{
				return "";
			}
			
		};
		*/

        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {

            $NASUsulan1 = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal());
                    //->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
                    //->andwhere(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL]);
            

            $NASUsulan2 = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan::find()
                    ->where($this->ZULAsal())
                    ->andwhere(['IN', 'Status_Penerimaan', [1,2]]);

            if ($NASModel->kelurahan != 0){
                $NASUsulan1->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
                //$NASUsulan2->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan1->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
                //$NASUsulan2->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
			$request = Yii::$app->request;
			if ($request->post("Kd_Prioritas_Pembangunan_Daerah")){
				$NASUsulan1->andWhere(['Kd_Prioritas_Pembangunan_Daerah' => $request->post("Kd_Prioritas_Pembangunan_Daerah")]);
                //$NASUsulan2->andWhere(['Kd_Prioritas_Pembangunan_Daerah' => $request->post("Kd_Prioritas_Pembangunan_Daerah")]);
			}
            // if($NASModel->kata_kunci !=0){
            //     $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            // }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

            return $this->renderPartial('lihat', [
                'NASUsulan1' => $NASUsulan1->all(),
				'opd'=>$opd,
				'model'=>$model,
                //'NASUsulan2' => $NASUsulan2->all()
                ]);
        }  
        else{
            // $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
            //     ->where($this->ZULAsal())
            //     ->all(),
            // 'Kd_Urut', 'Nm_Kel');

            $Kelurahan = ['0' => 'Tidak Memilih'];
            $data_kel = RefKelurahan::find()
                ->where($this->ZULAsal())
                ->all();
            foreach ($data_kel as $key => $value) {
                $Kelurahan[$value->Kd_Urut]= $value->Nm_Kel;
            }
            // print_r($Kelurahan);
            // die();

            $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                    ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
			//$rpjmd = ArrayHelper::map($rpjmd, 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
            array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
            
            return $this->render('index', [
                        'model' => $NASModel,
                        'Kelurahan' => $Kelurahan,
                        'ZUL_bid_pem' => $ZUL_bid_pem ,
						'rpjmd' => $rpjmd,
						'models'=>$ZULmodel
            ]);
        }

        
    }

    public function actionIndex2() {
        $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkugan::find()
                     ->where($this->ZULAsal());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            if($NASModel->kata_kunci !=0){
                $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
                    ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('lihat', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->ZULAsal())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
		
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('index', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }
    

    
    // public function actionCetak(){


    // $NASModel = new \yii\base\DynamicModel([
    //         'kelurahan', 'bid_pem', 'kata_kunci'
    //     ]);
    //     $kelurahan = "-";
    //     $bid_pem = "-";
    //     $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
    //              ->addRule(['kata_kunci'], 'string');
    //     if($NASModel->load(\Yii::$app->request->post())){
    //         $NASUsulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
    //                 ->where($this->ZULAsal());

    //         if ($NASModel->kelurahan != 0){
    //             $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASmodel->kelurahan]);
    //             $kelurahan = RefKelurahan::find()
    //                     ->where($this->ZULAsal())
    //                     ->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan])
    //                     ->one()->Nm_Kel;
    //         }

    //         if ($NASModel->bid_pem !=0){
    //             $NASUsulan->andWhere(['Kd_Pem' =>$NASModel->bid_pem]);
    //             $bid_pem = RefBidangPembangunan::find()
    //                     ->where(['Kd_Pem'=> $NASModel->bid_pem])
    //                     ->one()->Bidang_Pembangunan;

    //         }
    //         if ($NASModel->kata_kunci != ''){
    //             $NASModel->andWhere(['or', ['like', 'Nm_Permasalahan', $NASModel->kata_kunci],
    //                 ['like', 'Jenis_Usulan', $NASModel->kata_kunci]]);
                    
    //         }

    //         $pdf = new \kartik\mpdf\Pdf([
    //         'mode' => \kartik\mpdf\Pdf::MODE_UTF8, // leaner size using standard fonts
    //         'format' => \kartik\mpdf\Pdf::FORMAT_FOLIO,
    //         'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
    //         'content' => $this->renderPartial('print', [
    //           'NASUsulan' => $NASUsulan->all(),
    //             'kelurahan' => $kelurahan,
    //             'bid_pem' => $bid_pem,
    //             'kata_kunci' => $NASModel->kata_kunci,
    //             'rpjmd' => \eperencanaan\models\RefRPJMD::find()->all()]),
    //         'options' => [
    //             'title' => 'Usulan Kelurahan',
    //         //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
    //         ],
    //         'methods' => [
    //             'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 
    //                 \Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
    //                 \Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
    //                 (date('H:i:s'))],
    //             'SetFooter' => ['|Halaman {PAGENO}|'],
    //         ]
    //     ]);
    //     return $pdf->render(); 
    //     }
    // }
    
    public function actionCetak2(){


        $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        
        $kelurahan = "-";
        $bid_pem = "-";

        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if($NASModel->load(\Yii::$app->request->post())){
            $NASUsulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal());

        
            if ($NASModel->kelurahan !=0) {
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
                $kelurahan = RefKelurahan::find()
                        ->where($this->ZULAsal())
                        ->andWhere(['Kd_Urut' => $NASModel->kelurahan])
                        ->one()->Nm_Kel;
            }

            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' =>$NASModel->bid_pem]);
                $bid_pem = RefBidangPembangunan::find()
                        ->where(['Kd_Pem'=> $NASModel->bid_pem])
                        ->one()->Bidang_Pembangunan;

            }
            // if ($NASModel->kata_kunci != ''){
            //     $NASUsulan->andWhere(['or', ['like', 'Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan', $NASModel->kata_kunci]]);
                    
            // }

          return $this->renderPartial('cetakexcel', [
                'NASUsulan' => $NASUsulan->all(),
                'kelurahan' => $kelurahan,
                'bid_pem' => $bid_pem
                ]);

        }

    }

    public function actionCetak(){
        $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $kelurahan = "-";
        $bid_pem = "-";
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if($NASModel->load(\Yii::$app->request->post())){
            // $NASUsulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
            //         ->where($this->ZULAsal());

            $usulan1 = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal())
                    ->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
                    ->andwhere(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL]);
            

            $usulan2 = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan::find()
                    ->where($this->ZULAsal())
                    ->andwhere(['IN', 'Status_Penerimaan', [1,2]]);
            

            if ($NASModel->kelurahan !=0) {
                $usulan1->andwhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
                $usulan2->andwhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
                $kelurahan = RefKelurahan::find()
                        ->where($this->ZULAsal())
                        ->andwhere(['Kd_Urut' => $NASModel->kelurahan])
                        ->one()->Nm_Kel;
            }

            if ($NASModel->bid_pem !=0){
                $usulan1->andwhere(['Kd_Pem' =>$NASModel->bid_pem]);
                $usulan2->andwhere(['Kd_Pem' =>$NASModel->bid_pem]);
                $bid_pem = RefBidangPembangunan::find()
                        ->where(['Kd_Pem'=> $NASModel->bid_pem])
                        ->one()->Bidang_Pembangunan;
            }

            $usulans1 = $usulan1->all();
            $usulans2 = $usulan2->all();

            return $this->renderPartial('cetakexcel', [
                'usulan1' => $usulans1,
                'usulan2' => $usulans2,
                'kelurahan' => $kelurahan,
                'bid_pem' => $bid_pem
                ]);

        }

    }


    public function actionPasca() {
          $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaMusrenbang::find()
                     ->where($this->ZULAsal());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            if($NASModel->kata_kunci !=0){
                $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
                    ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('lihat_pasca', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->ZULAsal())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('pasca', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }
    
    public function actionCetakPasca(){
        $ZULmodel = new \yii\base\DynamicModel([
            'pri_pem', 'bid_pem', 'kata_kunci'
        ]);
        $lingkungan = '-';
        $bid_pem = '-';
        $ZULmodel->addRule(['pri_pem', 'bid_pem'], 'integer')
                ->addRule(['kata_kunci'], 'string');
        if ($ZULmodel->load(\Yii::$app->request->post())){ 
            $ZULusulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal());
            if ($ZULmodel->pri_pem != 0){
                 $ZULusulan->andWhere(['Kd_Prioritas_Pembangunan_Daerah' => $ZULmodel->pri_pem]);
                $lingkungan = RefRPJMD::find()
                    ->andWhere(['Kd_Prioritas_Pembangunan_Kota' => $ZULmodel->pri_pem])
                    ->one()->Nm_Prioritas_Pembangunan_Kota;
            }
            if  ($ZULmodel->bid_pem != 0){
                $ZULusulan->andWhere(['Kd_Pem' => $ZULmodel->bid_pem]);
                $bid_pem = RefBidangPembangunan::find()
                    ->where(['Kd_Pem' => $ZULmodel->bid_pem])
                    ->one()->Bidang_Pembangunan;
            }
            if ($ZULmodel->kata_kunci != ''){
                $ZULusulan->andWhere(['or', ['like','Nm_Permasalahan', $ZULmodel->kata_kunci],
                    ['like', 'Jenis_Usulan',$ZULmodel->kata_kunci]]);
            }
            
            $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => \kartik\mpdf\Pdf::FORMAT_FOLIO,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('print_pasca', [
                'ZULusulan' => $ZULusulan->all(),
                'lingkungan' => $lingkungan,
                'bid_pem' => $bid_pem,
                'kata_kunci' => $ZULmodel->kata_kunci,
                'rpjmd' => \eperencanaan\models\RefRPJMD::find()->all()]),
            'options' => [
                'title' => 'Usulan Kelurahan',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                    \Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    \Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render(); 
        }
    }


     public function actionLihat() {
        $ZULmodel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $ZULmodel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if ($ZULmodel->load(\Yii::$app->request->post())){ 
            $ZULusulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal());

            if ($ZULmodel->kelurahan != 0){
                $ZULusulan->andWhere(['Kd_Urut_Kel' => $ZULmodel->kelurahan]);
            }
            if  ($ZULmodel->bid_pem != 0){
                $ZULusulan->andWhere(['Kd_Pem' => $ZULmodel->bid_pem]);
            }
            if ($ZULmodel->kata_kunci != ''){
                $ZULusulan->andWhere(['or', ['like','Nm_Permasalahan', $ZULmodel->kata_kunci],
                    ['like', 'Jenis_Usulan',$ZULmodel->kata_kunci]]);
            }
            //$ZULusulan->all();
           // print_r($ZULusulan->all());exit;
            return $this->renderPartial('lihat', [
                'ZULusulan' => $ZULusulan->all()
                ]);
        }

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->ZULAsal())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);
        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        return $this->render('index', [
                    'model' => $ZULmodel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }


    //=====Padli=====//
	public function CekUsulan()
    {
        $posisi = $this->ZULAsal();

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"]);
				// ->andwhere(['!=', 'Skor', NULL]);
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                // ->groupby(["Kd_Pem","Kd_Prioritas_Pembangunan_Daerah"]);
        

        $usulan = $data->all();
        foreach($usulan as $u):
            $topScore = $this->topScore($u->Kd_Pem,$u->Kd_Prioritas_Pembangunan_Daerah);
            $TaMusrenbang = TaMusrenbang::find()
            ->where($posisi)
            //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
            ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
            ->andwhere(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$topScore['Skor'],"Urutan_Prioritas"=>0])
            ->count();
            if($TaMusrenbang == 1)
            {
               $TaMusrenbangSet = TaMusrenbang::find()
				->where($posisi)
				//->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
				->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
				->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
				->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
				->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
				->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
				->andwhere(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$topScore['Skor'],"Urutan_Prioritas"=>0])
				->one();
				
				$TaMusrenbangSet->Urutan_Prioritas = 1;
				$TaMusrenbangSet->save(false);
            }
            // print_r(["Kd_Pem"=>$u->Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$u->Kd_Prioritas_Pembangunan_Daerah,"Skor"=>$u->Skor,"Jumlah"=>$u->Jumlah]);
        endforeach;
        return;
    }

    public function topScore($Kd_Pem,$Kd_Prioritas_Pembangunan_Daerah)
    {
        $posisi = $this->ZULAsal();

        $data = TaMusrenbang::find()
                ->where($posisi)
                //->andwhere(['!=', 'Kd_Asal_Usulan', "3"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "4"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "5"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "6"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "7"])
                ->andwhere(['!=', 'Kd_Asal_Usulan', "8"])
                ->andwhere(["Kd_Pem"=>$Kd_Pem,"Kd_Prioritas_Pembangunan_Daerah"=>$Kd_Prioritas_Pembangunan_Daerah])
                //->andwhere(['IS', 'Status_Penerimaan_Kecamatan', NULL]); 
                ->orderby(["Skor" => SORT_DESC])
                ->one();
        return $data;
    }
	
    public function actionUsulanPrioritas() {
		$this->CekUsulan();
        $Posisi = $this->ZULAsal();
        
		$bidang_pembangunan = RefBidangPembangunan::find()->all();
        $data_usulan = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
		
		return $this->render('usulan_prioritas', [
			'bid_pem' => $bidang_pembangunan,
			'data_usulan' => $data_usulan,
        ]);
    }

    public function actionUsulanPrioritasCetak() {
        $PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
        $Nm_Kec = $PC_Kelompok->kdKec->Nm_Kec;

        $Posisi = $this->ZULAsal();
        $pem_1 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 1])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        
		$pem_2 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 2])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        
		$pem_3 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 3])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
						
		$pem_4 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 4])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        return $this->render('usulan_prioritas_cetak', [
			'pem_1'=>$pem_1,
			'pem_2'=>$pem_2,
			'pem_3'=>$pem_3,
			'pem_4'=>$pem_4,
        ]);
    }
 
    public function actionUsulanPrioritasCetak2() { //cadangan
        $PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
        $Nm_Kec = $PC_Kelompok->kdKec->Nm_Kec;

        $Posisi = $this->ZULAsal();
        $jlh_kelurahan = RefKelurahan::find()
                        ->where($Posisi)
                        ->count();

        $batas_infrastruktur=10 * $jlh_kelurahan;
        $batas_sosbud=3 * $jlh_kelurahan;
        $batas_ekonomi=3 * $jlh_kelurahan;
        
        $data_infrastruktur = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 1])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->limit($batas_infrastruktur)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC]);
        
        $data_sosbud = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 2])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->limit($batas_sosbud)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC]);
        
        $data_ekonomi = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 3])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['Urutan_Prioritas' => 1])
                        ->limit($batas_ekonomi)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC]);

        
        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => \kartik\mpdf\Pdf::FORMAT_FOLIO,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('usulan_prioritas_cetak', [
                'Nm_Kec' => $Nm_Kec,
                'data_infrastruktur' => $data_infrastruktur,
                'data_sosbud' => $data_sosbud,
                'data_ekonomi' => $data_ekonomi,
            ]),
            'options' => [
                'title' => 'Absensi',
            //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Dicetak dari: Sistem e-Planning '.$this->getKota().'||Dicetak tanggal: ' . 
                    \Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
                    \Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
                    (date('H:i:s'))],
                'SetFooter' => ['|Halaman {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionHasilSkoring() {
        $Posisi = $this->ZULAsal();
        $jlh_kelurahan = RefKelurahan::find()
                        ->where($Posisi)
                        ->count();

        $batas_infrastruktur=10 * $jlh_kelurahan;
        $batas_sosbud=3 * $jlh_kelurahan;
        $batas_ekonomi=3 * $jlh_kelurahan;
        
        $data_infrastruktur = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 1])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->limit($batas_infrastruktur)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        
        $data_sosbud = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 2])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->limit($batas_sosbud)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        
        $data_ekonomi = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['Kd_Pem' => 3])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
                        ->limit($batas_ekonomi)
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        //echo "$data_infrastruktur";
        //die();
        // $data_infrastruktur = [];
        // $data_sosbud = [];
        // $data_ekonomi = [];

        return $this->renderPartial('hasil_skoring', [
            'data_infrastruktur' => $data_infrastruktur,
            'data_sosbud' => $data_sosbud,
            'data_ekonomi' => $data_ekonomi,
        ]);
    }

    
    //============//
    public function actionUsulanCadangan() {
		$this->CekUsulan();
        $Posisi = $this->ZULAsal();
        
		$bidang_pembangunan = RefBidangPembangunan::find()->all();
        $data_usulan = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['!=', 'Urutan_Prioritas', 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
		
		return $this->render('usulan_cadangan', [
			'bid_pem' => $bidang_pembangunan,
			'data_usulan' => $data_usulan,
        ]);
    }

    public function actionUsulanCadanganCetak() {
        $Posisi = $this->ZULAsal();
        
		$pem_1 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 1])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['!=','Urutan_Prioritas', 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        
		$pem_2 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 2])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['!=','Urutan_Prioritas', 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        
		$pem_3 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 3])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['!=','Urutan_Prioritas', 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
						
		$pem_4 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 4])
                        ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                        ->andWhere(['>', 'skor', 0])
						->andWhere(['!=','Urutan_Prioritas', 1])
                        ->orderBy(['skor' => SORT_DESC, 'id' => SORT_ASC])
                        ->all();
        return $this->render('usulan_cadangan_cetak', [
			'pem_1'=>$pem_1,
			'pem_2'=>$pem_2,
			'pem_3'=>$pem_3,
			'pem_4'=>$pem_4,
        ]);

    }
    //============//
    public function actionUsulanKecamatan() {
        $Posisi = $this->ZULAsal();
		
		$ZULKecamatanModel = $this->ZULarraymap(Yii::$app->levelcomponent->getKelompok());
        unset($ZULKecamatanModel['Kd_Urut_Kel']);
        $ZULKecamatan = \eperencanaan\models\TaMusrenbangKecamatanAcara::findOne($ZULKecamatanModel);
        $ZULKecamatan = $ZULKecamatan !== null ? $ZULKecamatan : new TaMusrenbangKecamatanAcara();
						
		$bidang_pembangunan = RefBidangPembangunan::find()->all();
		$data_usulan = TaMusrenbang::find()
                        ->where($Posisi)
                        ->andWhere(['=', 'Kd_Asal_Usulan', '3'])
                        ->all();
        

        return $this->render('usulan_kecamatan', [
			'bid_pem' => $bidang_pembangunan,
			'data_usulan' => $data_usulan,
			'acara' => $ZULKecamatan
        ]);
    }  


    public function actionUsulanKecamatanCetak() {
        $Posisi = $this->ZULAsal();
						
		$pem_1 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 1])
                        ->andWhere(['=', 'Kd_Asal_Usulan', '3'])
                        ->all();
        
		$pem_2 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 2])
                        ->andWhere(['=', 'Kd_Asal_Usulan', '3'])
                        ->all();
        
		$pem_3 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 3])
                        ->andWhere(['=', 'Kd_Asal_Usulan', '3'])
                        ->all();
						
		$pem_4 = TaMusrenbang::find()
                        ->where($Posisi)
						->andWhere(['Kd_Pem' => 4])
                        ->andWhere(['=', 'Kd_Asal_Usulan', '3'])
                        ->all();
        return $this->render('usulan_kecamatan_cetak', [
			'pem_1'=>$pem_1,
			'pem_2'=>$pem_2,
			'pem_3'=>$pem_3,
			'pem_4'=>$pem_4,
        ]);
    }  
    //=======akhir padli=====//
}
