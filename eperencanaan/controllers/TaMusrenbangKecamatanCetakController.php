<?php

namespace eperencanaan\controllers;
use Yii;
use eperencanaan\models\TaMusrenbang;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use eperencanaan\models\TaMusrenbangKelurahan;
use common\models\RefKelurahan;
use common\models\RefBidangPembangunan;
use common\models\RefRPJMD;
use common\models\RefLingkungan;
use common\models\RefSubUnit;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;


class TaMusrenbangKecamatanCetakController extends \yii\web\Controller
{

    public function  Posisi()
    {
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        $pos = [
            'Kd_Prov' => $kelompok['Kd_Prov'],
            'Kd_Kab' => $kelompok['Kd_Kab'],
            'Kd_Kec' => $kelompok['Kd_Kec']
        ];
        return $pos;
    }

    public function Unit()
    {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        $unit = [
            'Kd_Urusan'     => $kelompok['Kd_Urusan'],
            'Kd_Bidang'     => $kelompok['Kd_Bidang'],
            'Kd_Unit'       => $kelompok['Kd_Unit'],
            'Kd_Sub_Unit'   => $kelompok['Kd_Sub_Unit']
        ];
        return $unit;
    }

    public function actionIndex()
    {
        $bid_pem    = RefBidangPembangunan::find()
                    ->all();

        $kelurahan  = RefKelurahan::find()
                    ->where($this->Posisi())
                    ->all();

        $rpjmd      = RefRPJMD::find()
                    ->all();

        return $this->render('index',[
            'kelurahan'=>$kelurahan,
            'bid_pem'=>$bid_pem,
            'rpjmd'=>$rpjmd,
            ]);
    }

    public function actionGetUsulan()
    {
        $request = Yii::$app->request;

        $Kd_Kel         = $request->post('Kd_Kel');
        $Kd_Lingkungan  = $request->post('Kd_Lingkungan');
        $Kd_Pem         = $request->post('Kd_Pem');
        $Kd_Prioritas_Pembangunan_Daerah = $request->post('Kd_Prioritas_Pembangunan_Daerah');

        $data = TaMusrenbang::find()
            ->where($this->Posisi())
            ->andwhere(['IS NOT', 'Skor', NULL])
            ->orderBy(['Skor'=>SORT_DESC]);

        if ($Kd_Kel) {
            $data->andwhere(['=', 'Kd_Urut_Kel', $Kd_Kel]);
        }

        if ($Kd_Lingkungan != '' || $Kd_Lingkungan != 0) {
            $data->andwhere(['=', 'Kd_Lingkungan', $Kd_Lingkungan]);
        }

        if ($Kd_Pem != '' || $Kd_Pem != 0) {
            $data->andwhere(['=', 'Kd_Pem', $Kd_Pem]);
        }

        if ($Kd_Prioritas_Pembangunan_Daerah != '' || $Kd_Prioritas_Pembangunan_Daerah != 0) {
            $data->andwhere(['=', 'Kd_Prioritas_Pembangunan_Daerah', $Kd_Prioritas_Pembangunan_Daerah]);
        }
        $usulan = $data->all();

        return $this->renderpartial('get_usulan',[
            'data'=>$usulan,
            ]);
    }


    public function actionGetLingkungan($Kd_Kel)
    {
        $Posisi = $this->Posisi();
        $lingkungan = RefLingkungan::find()
                    ->where($Posisi);
        
        echo '<option value="">-Pilih Lingkungan-</option>';
        foreach ($lingkungan as $key => $value) {
            echo '<option value="'.$value->Kd_Lingkungan.'">'.$value->Nm_Lingkungan.'</option>';
        }
    }

    public function actionCetak()
    {
        // PENING
    }


    public function actionTve311()
    {
        
        $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer');
                 // ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaMusrenbang::find()
                     ->where($this->posisi());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            // if($NASModel->kata_kunci !=0){
            //     $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            // }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('tve311_lihat', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->posisi())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('tve311', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
       
    }
    

    public function actionTve312()
    {
         $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer');
                 // ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaMusrenbang::find()
                     ->where($this->posisi());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            // if($NASModel->kata_kunci !=0){
            //     $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            // }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('tve312_lihat', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->posisi())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('tve312', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
       
    }


    public function actionTve312cetak(){


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
            

            $usulan = \eperencanaan\models\TaMusrenbang::find()
                    ->where($this->posisi());
            

            if ($NASModel->kelurahan !=0) {
                $usulan->andwhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
                $kelurahan = RefKelurahan::find()
                        ->where($this->posisi())
                        ->andwhere(['Kd_Urut' => $NASModel->kelurahan])
                        ->one()->Nm_Kel;
            }

            if ($NASModel->bid_pem !=0){
                $usulan->andwhere(['Kd_Pem' =>$NASModel->bid_pem]);
                $bid_pem = RefBidangPembangunan::find()
                        ->where(['Kd_Pem'=> $NASModel->bid_pem])
                        ->one()->Bidang_Pembangunan;
            }

            $usulans = $usulan->all();
        

           $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8, // leaner size using standard fonts
            'format' => \kartik\mpdf\Pdf::FORMAT_FOLIO,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
            'content' => $this->renderPartial('tve312_cetak', [
                'usulan' => $usulans,
                'kelurahan' => $kelurahan,
                'bid_pem' => $bid_pem,
                // 'kata_kunci' => $ZULmodel->kata_kunci,
                'rpjmd' => \eperencanaan\models\RefRPJMD::find()->all()]),
            'options' => [
                'title' => 'Daftar Prioritas Desa Menurut SKPD',
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

    public function actionTve313()
    {
              $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer');
                 // ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaMusrenbang::find()
                     ->where($this->posisi());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            // if($NASModel->kata_kunci !=0){
            //     $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            // }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('tve313_lihat', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->posisi())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('tve313', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }

    public function actionTve314()
    {
      $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer');
                 // ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaMusrenbang::find()
                     ->where($this->posisi());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            // if($NASModel->kata_kunci !=0){
            //     $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            // }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('tve314_lihat', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->posisi())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('tve314', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }

    public function actionTve315()
    {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $skpd = RefSubUnit::find()
        ->all();
        return $this->render('tve315',[
            'skpd' => $skpd,
            'Tahun' => $Tahun
            ]);
    }

}

?>