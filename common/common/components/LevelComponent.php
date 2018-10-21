<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TahunBerjalan
 *
 * @author webmaxindo
 */

namespace common\components;

use Yii;
use yii\base\Component;
use userlevel\models\TaUserKelompok;
use userlevel\models\TaUserLevel;
use userlevel\models\TaUserUnit;
use userlevel\models\TaProfile;
use common\models\RefLingkungan;
use common\models\RefKelurahan;
use common\models\RefKecamatan;
use common\models\RefSubUnit;
use common\models\TaUserDapil;
use common\models\TaPokirReses;

class LevelComponent extends Component {

    // //public $id = 2;

    public function getRoles() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;
            $roles = Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id);
            return $roles;
        }
    }

    public function PosisiUnit() {
        $unitskpd = $this->getUnit();
        $unit = [
            'Kd_Urusan' => $unitskpd['Kd_Urusan'],
            'Kd_Bidang' => $unitskpd['Kd_Bidang'],
            'Kd_Unit' => $unitskpd['Kd_Unit'],
            'Kd_Sub' => $unitskpd['Kd_Sub_Unit'],
        ];
        return $unit;
    }


    public function in_array_r($item , $array){
        return preg_match('/"'.$item.'"/i' , json_encode($array));
    }

    public function isRoles($cek) {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;
            $roles = Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id);;
            
            if($this->in_array_r($cek , $roles)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function getKelompok() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;
            //     $id= $this->id; //sementara
            return TaUserKelompok::find()->where(['Kd_User' => $id])->one();
        }
    }

    public function getUnit() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;

            //  $id= $this->id; //sementara
            $return = TaUserUnit::find()->where(['Kd_User' => $id])->one();

			return $return;
        }
    }

    public function getKelompokUnit() { //belum siap. akan digunakan sebagai nilai kembalian universal agar dapat digunakan oleh kelurahan sampai tingkat skpd
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;
            //     $id= $this->id; //sementara
            
            if ($this->getKelompok()) {
                return $this->getKelompok();
            }
            else{
                return $this->getUnit();
            }
        }
    }
    public function getProfile() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;
            return TaProfile::find()->where(['Kd_User' => $id])->one();
        }
    }
	
	public function getProfileByID($id) {
        return TaProfile::find()->where(['Kd_User' => $id])->one();
    }

    public function getLevel() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;

            //  $id= $this->id; //sementara
            return TaUserLevel::find()->where(['Kd_User' => $id])->one();
        }
    }

    public function getNamaLingkungan() {
        $PC_Kelompok = $this->getKelompok();
        $PC_Cari = RefLingkungan::find()->where([
                    'Kd_Prov' => $PC_Kelompok['Kd_Prov'],
                    'Kd_Kab' => $PC_Kelompok['Kd_Kab'],
                    'Kd_Kec' => $PC_Kelompok['Kd_Kec'],
                    'Kd_Kel' => $PC_Kelompok['Kd_Kel'],
                    'Kd_Urut_Kel' => $PC_Kelompok['Kd_Urut_Kel'],
                    'Kd_Lingkungan' => $PC_Kelompok['Kd_Lingkungan'],
                ])->one();
        return $PC_Cari['Nm_Lingkungan'];
    }
	
	public function getNamaOPD() {
        $PC_Kelompok = $this->getUnit();
        $PC_Cari = RefSubUnit::find()->where([
                    'Kd_Urusan' => $PC_Kelompok['Kd_Urusan'],
                    'Kd_Bidang' => $PC_Kelompok['Kd_Bidang'],
                    'Kd_Unit' => $PC_Kelompok['Kd_Unit'],
                    'Kd_Sub' => $PC_Kelompok['Kd_Sub_Unit'],
                ])->one();
        return $PC_Cari['Nm_Sub_Unit'];
    }

    public function getNamaKelurahan() {
        $PC_Kelompok = $this->getKelompok();
        $PC_Cari = RefKelurahan::find()->where([
                    'Kd_Prov' => $PC_Kelompok['Kd_Prov'],
                    'Kd_Kab' => $PC_Kelompok['Kd_Kab'],
                    'Kd_Kec' => $PC_Kelompok['Kd_Kec'],
                    'Kd_Kel' => $PC_Kelompok['Kd_Kel'],
                    'Kd_Urut' => $PC_Kelompok['Kd_Urut_Kel'],
                ])->one();
        return $PC_Cari['Nm_Kel'];
    }

    public function getJadwal() {
        $ZULwaktu = new \DateTime('now');
        $ZULhari = $ZULwaktu->format('Y-m-d H:i:s');
        //return $ZULhari;
        // $ZULtanggal = \common\models\TaKalenderLayout::find()
        //                 ->joinWith('kdKalender')
        //                 ->where(['<', 'Ta_Kalender.Waktu_Mulai', $ZULhari])
        //                 ->andWhere(['>', 'Ta_Kalender.Waktu_Selesai', $ZULhari])
        //                 ->one()
        //                 ->Jadwal;
        return 4 ;//$ZULtanggal;

    }

    public function getWaktuAcara() {
        $ZULkelompok = $this->getKelompok();
        if ($ZULkelompok['Kd_Lingkungan'] !== 0) {
            $ZULacara = \eperencanaan\models\TaForumLingkunganAcara::findOne([
                        'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                        'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                        'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                        'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                        'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
                        'Kd_Lingkungan' => $ZULkelompok['Kd_Lingkungan'],
            ]);
        } else if ($ZULkelompok['Kd_Kel'] !== 0) {
            $ZULacara = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne([
                        'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                        'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                        'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                        'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                        'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
            ]);
        } else if ($ZULkelompok['Kd_Kec'] !== 0) {
            $ZULacara = \eperencanaan\models\TaMusrenbangKecamatanAcara::findOne([
                        'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                        'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                        'Kd_Kec' => $ZULkelompok['Kd_Kec'],
            ]);
        }

        if (!isset($ZULacara)) {
            return 0;
        } else if ($ZULacara->Waktu_Mulai == 0) {
            return 1;
        } else if ($ZULacara->Waktu_Selesai == 0) {
            return 2;
        } else {
            return 3;
        }
    }
	
	public function getWaktuOpd() {
        $ZULkelompok = $this->getUnit();
        $ZULacara = \eperencanaan\models\MusrenbangSkpdAcara::findOne([
                        'Kd_Urusan' => $ZULkelompok['Kd_Urusan'],
                        'Kd_Bidang' => $ZULkelompok['Kd_Bidang'],
                        'Kd_Unit' => $ZULkelompok['Kd_Unit'],
                        'Kd_Sub_Unit' => $ZULkelompok['Kd_Sub_Unit'],
            ]);

        if (!isset($ZULacara)) {
            return 0;
        } else if ($ZULacara->Waktu_Mulai == 0) {
            return 1;
        } else if ($ZULacara->Waktu_Selesai == 0) {
            return 2;
        } else {
            return 3;
        }
    }

    public function getVerifikasiKelurahan() {
        $ZULkelompok = $this->getKelompok();
        $ZULstatus0 = \eperencanaan\models\TaForumLingkungan::find()
                        ->where([
                            'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                            'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                            'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                            'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                            'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
                                // 'Kd_Lingkungan' => $ZULkelompok['Kd_Lingkungan'],
                        ])->count();
        $ZULstatus1 = \eperencanaan\models\TaForumLingkungan::find(
                )->where(['Kd_Prov' => $ZULkelompok['Kd_Prov'],
                    'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                    'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                    'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                    'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
                    'Status_Pembahasan' => '1'])->count();

        return $ZULstatus0 == $ZULstatus1;
    }

    public function getStatusPengelompokanKelurahan() {
        $ZULkelompok = $this->getKelompok();
        $ZULstatus0 = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan::find()
                        ->where([
                            'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                            'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                            'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                            'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                            'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
                            
                                // 'Kd_Lingkungan' => $ZULkelompok['Kd_Lingkungan'],
                        ])->andWhere(['<>','Status_Penerimaan', '3'])->count();
        $ZULstatus1 = \eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan::find(
                )->where(['Kd_Prov' => $ZULkelompok['Kd_Prov'],
                    'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                    'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                    'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                    'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
                    'Status_Pengelompokan' => '1'])->count();

        return $ZULstatus0 != 0 && $ZULstatus0 == $ZULstatus1;
    }

    public function getStatusPembahasan() {
        $ZULkelompok = $this->getKelompok();
        if ($ZULkelompok['Kd_Lingkungan'] !== 0) {
            $ZULacara = \eperencanaan\models\TaForumLingkunganAcara::findOne([
                        'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                        'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                        'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                        'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                        'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
                        'Kd_Lingkungan' => $ZULkelompok['Kd_Lingkungan'],
            ]);
        } else if ($ZULkelompok['Kd_Kel'] !== 0) {
            $ZULacara = \eperencanaan\models\TaMusrenbangKelurahanAcara::findOne([
                        'Kd_Prov' => $ZULkelompok['Kd_Prov'],
                        'Kd_Kab' => $ZULkelompok['Kd_Kab'],
                        'Kd_Kec' => $ZULkelompok['Kd_Kec'],
                        'Kd_Kel' => $ZULkelompok['Kd_Kel'],
                        'Kd_Urut_Kel' => $ZULkelompok['Kd_Urut_Kel'],
            ]);
        }
        if (isset($ZULacara)) {
            return $ZULacara->Status_Pembahasan_Usulan;
        }
    }
	public function getNamaSkpdByUrusanSektor(){
        $kdUrusan  = Yii::$app->user->identity->id_urusan;
        $kdBidang  = Yii::$app->user->identity->id_bidang;
        $kdUnit    = Yii::$app->user->identity->id_skpd;
        $kdSub     = Yii::$app->user->identity->id_subunit;

        if($kdSub!=0){
            $data=RefSubUnit::find()->where(['Kd_Urusan'=>$kdUrusan, 'Kd_Bidang'=>$kdBidang, 'Kd_Unit'=>$kdUnit,'Kd_Sub'=>$kdSub])->one();
            return isset($data) ? $data['Nm_Sub_Unit'] : '-';
        }else{
            $data=RefUnit::find()->where(['Kd_Urusan'=>$kdUrusan, 'Kd_Bidang'=>$kdBidang, 'Kd_Unit'=>$kdUnit])->one();
            return isset($data) ? $data['Nm_Unit'] : '-';
        }
    }



    public function getKelompokPokir() {
        if (!empty(Yii::$app->user->identity->id)) {
            $id = Yii::$app->user->identity->id;

            //  $id= $this->id; //sementara
            return TaUserDapil::find()->where(['Kd_User' => $id])->one();
        }
    }
	
	public function getKelompokPokirByID($id) {
        return TaUserDapil::find()->where(['Kd_User' => $id])->one();
    }


    public function getPokirAcara() {
        $ZULkelompok = $this->getKelompokPokir();
        $TaPokirReses = TaPokirReses::find()->one();
        $ZULacara = \eperencanaan\models\TaPokirAcara::find()->where([
                        'Kd_User' => $ZULkelompok['Kd_User'],
                        'Masa_Reses' => $TaPokirReses->Masa_Reses,
            ])->one();
       
        if (!isset($ZULacara)) {
            return 0;
        } else if ($ZULacara->Waktu_Mulai == 0) {
            return 1;
        } else if ($ZULacara->Waktu_Selesai == 0) {
            return 2;
        } else {
            return 3;
        }
    }

    public function getServerName()
    {
        return isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null;
    }

       public function getUserHost()
    {
        return isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : null;
    }

}
