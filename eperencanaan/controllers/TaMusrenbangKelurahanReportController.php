<?php

namespace eperencanaan\controllers;

use yii;
use common\models\RefLingkungan;
use common\models\RefBidangPembangunan;
use common\models\RefRPJMD;
use yii\helpers\ArrayHelper;

class TaMusrenbangKelurahanReportController extends \yii\web\Controller {

    public function ZULAsal() {
        $ZULkelompok = \Yii::$app->levelcomponent->getKelompok();
        return [
            'Kd_Prov' => $ZULkelompok->Kd_Prov,
            'Kd_Kab' => $ZULkelompok->Kd_Kab,
            'Kd_Kec' => $ZULkelompok->Kd_Kec,
            'Kd_Kel' => $ZULkelompok->Kd_Kel,
            'Kd_Urut_Kel' => $ZULkelompok->Kd_Urut_Kel,
        ];
    }
	
	public function getKota() {
		return Yii::$app->pengaturan->Kolom('Nm_Pemda');
	}

    public function actionIndex() {
        $ZULmodel = new \yii\base\DynamicModel([
            'lingkungan', 'bid_pem', 'kata_kunci'
        ]);
        $ZULmodel->addRule(['lingkungan', 'bid_pem'], 'integer')
                ->addRule(['kata_kunci'], 'string');
        if ($ZULmodel->load(\Yii::$app->request->post())){ 
            $ZULusulan = \eperencanaan\models\TaForumLingkungan::find()
                    ->where($this->ZULAsal());
            if ($ZULmodel->lingkungan != 0){
                $ZULusulan->andWhere(['Kd_Lingkungan' => $ZULmodel->lingkungan]);
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
        // $ZUL_lingkungan = ArrayHelper::map(RefLingkungan::find()
        //         ->where($this->ZULAsal())
        //         ->all(),'Kd_Lingkungan', 'Nm_Lingkungan');
        // array_splice($ZUL_lingkungan, 0, 0, ['0' => 'Tidak Memilih']);

        $ling=RefLingkungan::find()
                ->where($this->ZULAsal())
                ->all();

        $dat_lingkungan=[];
        $dat_lingkungan[0]="Tidak Pilih";

        foreach ($ling as $key => $lingkungan) {
            $dat_lingkungan[$lingkungan->Kd_Lingkungan]=$lingkungan->Nm_Lingkungan;
        }        

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        return $this->render('index', [
                    'model' => $ZULmodel,
                    'ZUL_lingkungan' => $dat_lingkungan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }
    
    public function actionCetak(){
        $Tahun = \Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = \Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = \Yii::$app->pengaturan->Kolom('Kd_Kab');

        $ZULmodel = new \yii\base\DynamicModel([
            'lingkungan', 'bid_pem', 'kata_kunci'
        ]);
        $lingkungan = '-';
        $bid_pem = '-';
        $ZULmodel->addRule(['lingkungan', 'bid_pem'], 'integer')
                ->addRule(['kata_kunci'], 'string');
        if ($ZULmodel->load(\Yii::$app->request->post())){ 
            $ZULusulan = \eperencanaan\models\TaForumLingkungan::find()
                    ->where($this->ZULAsal());
            if ($ZULmodel->lingkungan != 0){
                $ZULusulan->andWhere(['Kd_Lingkungan' => $ZULmodel->lingkungan]);
                $lingkungan = RefLingkungan::find()
                    ->where($this->ZULAsal())
                    ->andWhere(['Kd_Lingkungan' => $ZULmodel->lingkungan])
                    ->one()->Nm_Lingkungan;
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
            'content' => $this->renderPartial('print', [
                'ZULusulan' => $ZULusulan->all(),
                'lingkungan' => $lingkungan,
                'bid_pem' => $bid_pem,
                'kata_kunci' => $ZULmodel->kata_kunci,
                'rpjmd' => \eperencanaan\models\RefRPJMD::find()->where([ 'Tahun'=>$Tahun, 'Kd_Prov'=>$Kd_Prov, 'Kd_Kab'=>$Kd_Kab,  ])->all()]),
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
    }
    
    public function actionPasca() {
        $Tahun = Yii::$app->pengaturan->Kolom('Tahun');
        $Kd_Prov = Yii::$app->pengaturan->Kolom('Kd_Prov');
        $Kd_Kab = Yii::$app->pengaturan->Kolom('Kd_Kab');

        $ZULmodel = new \yii\base\DynamicModel([
            'pri_pem', 'bid_pem', 'kata_kunci'
        ]);
        $ZULmodel->addRule(['pri_pem', 'bid_pem'], 'integer')
                ->addRule(['kata_kunci'], 'string');
        if ($ZULmodel->load(\Yii::$app->request->post())){ 
            $ZULusulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal());
            if ($ZULmodel->pri_pem != 0){
                $ZULusulan->andWhere(['Kd_Prioritas_Pembangunan_Daerah' => $ZULmodel->pri_pem]);
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
            return $this->renderPartial('lihat_pasca', [
                'ZULusulan' => $ZULusulan->all()
                ]);
        }
        $ZUL_lingkungan = ArrayHelper::map(\common\models\RefRPJMD::find()
                ->where(['Tahun' => $Tahun, 'Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab])
                ->all(),'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota');
        array_splice($ZUL_lingkungan, 0, 0, ['0' => 'Tidak Memilih']);
        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        return $this->render('pasca', [
                    'model' => $ZULmodel,
                    'ZUL_lingkungan' => $ZUL_lingkungan,
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
    }
}
