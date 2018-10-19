<?php

namespace eperencanaan\controllers;

use Yii;
use common\models\RefKelurahan;
use eperencanaan\models\TaMusrenbangKelurahan;
use common\models\TaKelurahanVerikfikasiLingkungan;
use userlevel\models\TaUserKelompok;
use userlevel\models\TaProfile;
use userlevel\models\User;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use common\models\RefLingkungan;

class TaMusrenbangKecamatanExplorerController extends \yii\web\Controller
{
	public function Posisi(){
        $kelompok = Yii::$app->levelcomponent->getKelompok();
        return [
            'Kd_Prov' => $kelompok->Kd_Prov,
            'Kd_Kab' => $kelompok->Kd_Kab,
            'Kd_Kec' => $kelompok->Kd_Kec
        ];
    }

    public function actionIndex()
    {
    	$posisi = $this->Posisi();
    	$data = RefKelurahan::find()
    		->where($posisi)
            ->all();
        return $this->render('index',[
        		'data' => $data
        ]);
    }

    public function actionGetUsulanKelurahan($kel, $urut)
    {
        $posisi = $this->Posisi();
    	// $data = TaMusrenbangKelurahan::find()
    	// 	->where($posisi)
     //        ->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
     //        ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut])
     //        ->andwhere(['Status_Pembahasan'=>'0'])   
     //        ->andwhere(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL]);
    		

     //     $data1 = TaKelurahanVerifikasiUsulanLingkungan::find()
     //                ->where($posisi)
     //                ->andwhere(['Status_Penerimaan' => '0']);

         // $data1 += count($data2->all());      

       $usulan1 = TaMusrenbangKelurahan::find()
              ->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
              ->where(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL])
              ->andwhere($posisi)
              ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut])
              ->all();

        // $usulan2 = TaKelurahanVerifikasiUsulanLingkungan::find()
        //       ->where(['IN', 'Status_Penerimaan', [1,2]])
        //       ->andwhere($Posisi)
        //       ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut])
        //       ->all();
         
    	return $this->renderpartial('get_usulan',[
    		'data' => $usulan1, 
        ]);
    }

    public function actionGetUsulanLingkungan($kel, $urut, $lingkungan)
    {
        $posisi = $this->Posisi();

        $usulan = TaKelurahanVerifikasiUsulanLingkungan::find()
              ->where(['IN', 'Status_Penerimaan', [1,2]])
              ->andwhere($posisi)
              ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut, 'Kd_Lingkungan'=>$lingkungan])
              ->all();

        return $this->renderpartial('get_usulan_lingkungan',[
            'data' => $usulan, 
        ]);
    }

    public function actionGetUsulanVerifikasi($kel, $urut)
    {
        $posisi = $this->Posisi();
        $data = TaMusrenbangKelurahan::find()
           ->where($posisi)
            ->leftJoin('Ta_Relasi_Musrenbang_Kelurahan', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan = Ta_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan')
            ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut])
            ->andwhere(['Status_Pembahasan'=>'1'])   
            ->andwhere(['IS', 'Ta_Relasi_Musrenbang_Kelurahan.Kd_Ta_Musrenbang_Kelurahan', NULL]);
           

        $data1 = TaKelurahanVerifikasiUsulanLingkungan::find()
                    ->where($posisi)
                    ->andwhere(['Status_Penerimaan' => '1']);    

        return $this->renderpartial('get_usulan',[
            'data' => $data->all(),
            'data1'=> $data1->all()]);
    }

    public function actionGetPj($kel, $urut)
    {
        $posisi = $this->Posisi();
        $data = TaUserKelompok::find()
            ->where($posisi)
            ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut])
            ->one()
            ->Kd_User;
       
        $data_pj = User::findOne(['id' => $data]);
        $nama_pj = TaProfile::findOne(['Kd_User' => $data]);

        return $this->renderpartial('get_pj',[
            'data_pj'=>$data_pj,
            'nama_pj'=>$nama_pj
        ]);
    }

    public function actionGetLingkungan($kel, $urut)
    {
        $Posisi = $this->Posisi();

        $lingkungan = RefLingkungan::find()
                    ->where($Posisi)
                    ->andwhere(['Kd_Kel'=>$kel, 'Kd_Urut_Kel'=>$urut])
                    ->all();

        return $this->renderpartial('get_lingkungan',[
            'lingkungan'=>$lingkungan,
        ]);
        
    }

    public function actionGetKelurahanAcara()
    {
        $Posisi = $this->Posisi();

        $kelurahan = RefKelurahan::find()
                    ->where($Posisi)
                    ->all();

        return $this->renderpartial('get_kelurahan_acara',[
            'kelurahan'=>$kelurahan,
        ]);
        
    }

}
