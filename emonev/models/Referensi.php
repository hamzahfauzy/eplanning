<?php

namespace emonev\models;

use Yii;
use yii\base\Model;
use emusrenbang\models\PrioritasNasional;
use emusrenbang\models\Urusan;
use common\models\RefUrusan;
use common\models\RefSumberDana;
use common\models\RefKegiatan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefFungsi;
use common\models\RefIndikator;
use common\models\RefJabatan;
use common\models\TaMisi;
use common\models\TaIndikator;
use common\models\LevelAplikasi;
use common\models\Menu;
use common\models\Levels;
use common\models\RefKamusProgram;
use common\models\RefApPub;
use emusrenbang\models\RefPenilaian;
use emusrenbang\models\KegiatanSkpd;
use emusrenbang\models\TaPaguProgram;
use emusrenbang\models\TaBelanja;
use emusrenbang\models\TaKegiatan;
use emusrenbang\models\Satuan;
use common\models\RefStandardSatuan;

use emusrenbang\models\ProgramNasional;

use common\models\RefProgram;
use common\models\RefLevel;


class Referensi extends Model {

    public function getLevelName($id) {
        $level = RefLevel::findOne($id);
        return $level->Nm_Level;
    }

    public function getRefApPub() {
        $model = RefApPub::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Ap_Pub']] = $d['Nm_Ap_Pub'];
        }
        return $data;
    }

    public function getDsnAttribute($name, $dsn) {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }

    public function getRefPenilaian() {
        $model = RefPenilaian::find()->orderBy(['Penilaian' => SORT_ASC])->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['ID']] = $d['Penilaian'];
        }
        return $data;
    }

    public function getKdKamusProgram() {
        $model = RefKamusProgram::find()->orderBy(['Kd_Program' => SORT_DESC])->one();
        if (isset($model->Kd_Program)) {
            $no = $model->Kd_Program + 1;
        } else {
            $no = 1;
        }
        return $no;
    }

    public function getLevel() {
        $model = Levels::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['id']] = $d['level'];
        }
        return $data;
    }

    public function findUser($user) {
        $model = User::find()->all();
    }

    public function getUser() {
        $model = User::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['username']] = $d['nama_lengkap'];
        }
        return $data;
    }

    public function getAplikasi() {
        $model = LevelAplikasi::find()->all();
        $data[0] = 'Pilih Aplikasi';
        foreach ($model as $d) {
            $data[$d['id']] = $d['aplikasi'];
        }
        return $data;
    }

    public function getMenu() {
        $model = Menu::find()->all();
        $data[0] = 'Parent';
        foreach ($model as $d) {
            $data[$d['id']] = $d['namaMenu'];
        }
        return $data;
    }

    public function getPrioritas() {
        $model = PrioritasNasional::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['id']] = $d['prioritas_nasional'];
        }
        return $data;
    }

    public function getUserBapeda() {
        // $model=User::find()->where(['id_level'=>'8'])->all();
        $sql = "select * from user where id_level in (8,13) order by id_level";
        $model = Yii::$app->db->createCommand($sql)->queryAll();

        $data = array();
        foreach ($model as $d) {
            $data[$d['username']] = $d['username'];
        }

        return $data;
    }

    public function getUrusan() {
        $model = RefUrusan::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Urusan']] = $d['Nm_Urusan'];
        }
        return $data;
    }

    public function getJabatan() {
        $model = RefJabatan::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Jab']] = $d['Nm_Jab'];
        }
        return $data;
    }

    public function getNoTaMisi() {
        $identity = Yii::$app->user->identity;
        $kdurusan = $identity->id_urusan;
        $kdbidang = $identity->id_bidang;
        $kdunit = $identity->id_skpd;
        $kdsub = $identity->id_subunit;
        $model = TaMisi::find()->where(['Kd_Urusan' => $kdurusan, 'Kd_Bidang' => $kdbidang, 'Kd_Unit' => $kdunit, 'Kd_Sub' => $kdsub])->orderBy(['No_Misi' => SORT_DESC])->one();
        if (isset($model->No_Misi)) {
            $no = $model->No_Misi + 1;
        } else {
            $no = 1;
        }
        return $no;
    }

    public function getUrusandaerah() {
        $model = Urusan::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['id']] = $d['urusan'];
        }
        return $data;
    }

    public function getIndikator() {
        $model = RefIndikator::find()->all();
        $data = array();
        foreach ($model as $d) {
            if ($d['Kd_Indikator'] >= 6)
                $data[$d['Kd_Indikator']] = $d['Nm_Indikator'];
        }
        return $data;
    }

    public function getFungsi() {
        $model = RefFungsi::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Fungsi']] = $d['Nm_Fungsi'];
        }
        return $data;
    }

    public function autoProgram() {
        $sql = "select distinct(Ket_Program) as program from Ref_Program order by Ket_Program ASC";
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($query as $d) {
            if (isset($data)) {
                $data .= ",'$d[program]'";
            } else {
                $data = "'$d[program]'";
            }
        }
        return $data;
    }

    public function autoKegiatan() {
        $sql = "select distinct(Ket_Kegiatan) as kegiatan from Ref_Kegiatan order by Ket_Kegiatan ASC";
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        $data = "";
        foreach ($query as $d) {
            $keg = addslashes($d['kegiatan']);
            if (isset($data)) {
                $data .= ",'$keg'";
            } else {
                if (!empty($d['kegiatan'])) {
                    $data = "'$keg'";
                }
            }
        }
        return $data;
    }

    public function getBidangUrusan($Kd_Urusan) {
        $model = RefBidang::find()->where(['Kd_Urusan' => $Kd_Urusan])->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Bidang']] = $d['Nm_Bidang'];
        }
        return $data;
    }

    public function getProgramBidangUrusan($Kd_Urusan, $Kd_Bidang) {
        $model = RefProgram::find()->where(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang])->all();
        foreach ($model as $d) {
            $data[$d['Kd_Prog']] = $d['Ket_Program'];
        }
        if (empty($data)) {
            return $data = array();
        } else {
            return $data;
        }
    }

    public function getUnitBidangUrusan($Kd_Urusan, $Kd_Bidang) {
        $model = RefUnit::find()->where(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang])->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Unit']] = $d['Nm_Unit'];
        }
        return $data;
    }

    public function getSubUnitBidangUrusan($Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
        $model = RefSubUnit::find()->where(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit])->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Sub']] = $d['Nm_Sub_Unit'];
        }
        return $data;
    }

    public function dropRefSumberDana() {
        $model = RefSumberDana::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Sumber']] = $d['Nm_Sumber'];
        }
        return $data;
    }

    public function getKegiatanOne($kdkeg) {
        $model = RefKegiatan::find()->where(['Kd_Keg' => $kdkeg])->one();
        return $model->Ket_Kegiatan;
    }
    //By RG
   public function getPaguOne($pagu) {
        $model = RefKegiatan::find()->where(['Pagu1' => $pagu])->one();
        return $model->Pagu_Indikatif;
       	
    }
    //------
    public function getUrusanOne($Kd_Urusan) {
        $model = RefUrusan::find()->where(['Kd_Urusan' => $Kd_Urusan])->one();
        return $model;
    }

    public function getBidangOne($Kd_Urusan, $Kd_Bidang) {
        $model = RefBidang::find()->where([
                    'Kd_Urusan' => $Kd_Urusan,
                    'Kd_Bidang' => $Kd_Bidang
                ])->one();
        return $model;
    }

    public function getUnitOne($Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
        $model = RefUnit::find()->where([
                    'Kd_Urusan' => $Kd_Urusan,
                    'Kd_Bidang' => $Kd_Bidang,
                    'Kd_Unit' => $Kd_Unit
                ])->one();
        return $model;
    }

    public function getSubUnitOne($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub) {
        $model = RefSubUnit::find()->where([
                    'Kd_Urusan' => $Kd_Urusan,
                    'Kd_Bidang' => $Kd_Bidang,
                    'Kd_Unit' => $Kd_Unit,
                    'Kd_Sub' => $Kd_Sub
                ])->one();
        return $model;
    }

    public function getProgramByBidangUrusanProgramOne($Kd_Urusan, $Kd_Bidang, $Kd_Prog) {
        $model = RefProgram::find()->where([
                    'Kd_Urusan' => $Kd_Urusan,
                    'Kd_Bidang' => $Kd_Bidang,
                    'Kd_Prog' => $Kd_Prog
                ])->one();
        return $model;
    }

    public function getKegiatanByOne($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg) {
        $model = RefKegiatan::find()->where([
                    'Kd_Urusan' => $Kd_Urusan,
                    'Kd_Bidang' => $Kd_Bidang,
                    'Kd_Prog' => $Kd_Prog,
                    'Kd_keg' => $Kd_Keg
                ])->one();
        return $model;
    }

    public function getJabatanByOne($Kd_Jab) {
        $model = RefJabatan::find()->where([
                    'Kd_Jab' => $Kd_Jab
                ])->one();
        return $model;
    }

    public function getKegiatanByCount($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Prog) {

        $cookies = Yii::$app->request->cookies;
        if (!empty($cookies['skpd'])) {
            $Kd_Sub = $cookies['subUnit']->value;
        } else {
            $Kd_Sub = Yii::$app->user->identity->id_subunit;
        }

        if ($Kd_Sub != 0) {
            $Kd_Sub = Yii::$app->user->identity->id_subunit;
        } else {
            $Kd_Sub = $Kd_Unit;
        }

        $model = KegiatanSkpd::find()
                ->innerJoin('Ref_Program rp', '
            rp.Kd_Urusan = kegiatan_skpd.Kd_Urusan and
            rp.Kd_Bidang = kegiatan_skpd.Kd_Bidang and
            rp.Kd_Prog   = kegiatan_skpd.Kd_Program
        ')
                ->innerJoin('Ref_Kegiatan rk', '
            rk.Kd_Urusan=kegiatan_skpd.Kd_Urusan and
            rk.Kd_Bidang=kegiatan_skpd.Kd_Bidang and
            rk.Kd_Prog=kegiatan_skpd.Kd_Program and
            rk.Kd_Keg=kegiatan_skpd.Kd_Kegiatan
        ');

        if ($Kd_Urusan and $Kd_Bidang and $Kd_Unit and $Kd_Prog) {
            $model->where([
                'kegiatan_skpd.Kd_Urusan' => $Kd_Urusan,
                'kegiatan_skpd.Kd_Bidang' => $Kd_Bidang,
                'kegiatan_skpd.Kd_Unit' => $Kd_Unit,
                'kegiatan_skpd.Kd_Sub' => $Kd_Sub,
                'kegiatan_skpd.Kd_Program' => $Kd_Prog
            ])->groupBy(['kegiatan_skpd.Kd_Program', 'kegiatan_skpd.Kd_Kegiatan']);
        }

        return $model->count();

        // $model=RefKegiatan::find()->where([
        //     'Kd_Urusan'=>$Kd_Urusan,
        //     'Kd_Bidang'=>$Kd_Bidang,
        //     'Kd_Prog'=>$Kd_Prog
        // ])->count();
        // return $model;
    }

    public function getProgramCount($Kd_Urusan = null, $Kd_Bidang = null) {
        $model = RefProgram::find();
        if ($Kd_Urusan and $Kd_Bidang) {
            $model->where([
                'Kd_Urusan' => $Kd_Urusan,
                'Kd_Bidang' => $Kd_Bidang
            ]);
        }

        return $model->count();
    }

    public function getProgramCountMusren($Kd_Urusan = null, $Kd_Bidang = null) {
        $model = RefProgram::find()->leftJoin('Ref_Kamus_Program kp', 'kp.Kd_Program=Ref_Program.Kd_Prog');
        if ($Kd_Urusan and $Kd_Bidang) {
            $model->where([
                'status' => 2,
                'Kd_Urusan' => $Kd_Urusan,
                'Kd_Bidang' => $Kd_Bidang
            ]);
        }

        return $model->count();
    }

    public function getKegiatanCount($Kd_Urusan = null, $Kd_Bidang = null, $Kd_Unit = null) {
        // $kelompok = Yii::$app->levelcomponent->getUnit();
        $model = RefKegiatan::find()
                ->innerJoin('kegiatan_skpd ks', '
            ks.Kd_Urusan = Ref_Kegiatan.Kd_Urusan and
            ks.Kd_Bidang = Ref_Kegiatan.Kd_Bidang and
            ks.Kd_Program = Ref_Kegiatan.Kd_Prog and
            ks.Kd_Kegiatan = Ref_Kegiatan.Kd_Keg
        ')
                ->innerJoin('Ref_Program rp', '
            rp.Kd_Urusan = ks.Kd_Urusan and
            rp.Kd_Bidang = ks.Kd_Bidang and
            rp.Kd_Prog   = ks.Kd_Program
        ');

        if ($Kd_Urusan and $Kd_Bidang and $Kd_Unit) {
            $model->where([
                'ks.Kd_Urusan' => $Kd_Urusan,
                'ks.Kd_Bidang' => $Kd_Bidang,
                'ks.Kd_Unit' => $Kd_Unit
            ])->groupBy(['ks.Kd_Program', 'ks.Kd_Kegiatan']);
        } else {
            $model->groupBy(['ks.Kd_Urusan', 'ks.Kd_Bidang', 'ks.Kd_Program', 'kegiatan_skpd.Kd_Kegiatan']);
        }
        //         ->innerJoin('Ref_Program rp', '
        //     rp.Kd_Urusan = kegiatan_skpd.Kd_Urusan and
        //     rp.Kd_Bidang = kegiatan_skpd.Kd_Bidang and
        //     rp.Kd_Prog   = kegiatan_skpd.Kd_Program
        // ')
        //         ->innerJoin('Ref_Kegiatan rk', '
        //     rk.Kd_Urusan=kegiatan_skpd.Kd_Urusan and
        //     rk.Kd_Bidang=kegiatan_skpd.Kd_Bidang and
        //     rk.Kd_Prog=kegiatan_skpd.Kd_Program and
        //     rk.Kd_Keg=kegiatan_skpd.Kd_Kegiatan
        // ');

        // if ($Kd_Urusan and $Kd_Bidang and $Kd_Unit) {
        //     $model->where([
        //         'kegiatan_skpd.Kd_Urusan' => $Kd_Urusan,
        //         'kegiatan_skpd.Kd_Bidang' => $Kd_Bidang,
        //         'kegiatan_skpd.Kd_Unit' => $Kd_Unit
        //     ])->groupBy(['kegiatan_skpd.Kd_Program', 'kegiatan_skpd.Kd_Kegiatan']);
        // } else {
        //     $model->groupBy(['kegiatan_skpd.Kd_Urusan', 'kegiatan_skpd.Kd_Bidang', 'kegiatan_skpd.Kd_Program', 'kegiatan_skpd.Kd_Kegiatan']);
        // }

        return $model->count();
        return;
    }

    public function getKegiatanPreset() {

        $query = Yii::$app->db->createCommand('SELECT  * FROM  kegiatan_skpd ks
            inner join Ref_Unit ur on ur.Kd_Urusan=ks.Kd_Urusan and ur.Kd_Bidang=ks.Kd_Bidang and ur.Kd_Unit=ks.Kd_Unit
            where ks.Kd_Urusan != 0
            and ks.Kd_Bidang != 0 and ks.Kd_Unit != 0
            GROUP BY ks.Kd_Urusan,ks.Kd_Bidang,ks.Kd_unit  LIMIT 5');


        $result = $query->queryAll();
        $total = $this->getKegiatanCount();
        $total = isset($total) ? $total : 0;
        $resultData = array();
        foreach ($result as $key => $value) {
            $array = array();
            $data = $this->getKegiatanCount($value['Kd_Urusan'], $value['Kd_Bidang'], $value['Kd_Unit']);
            $array['nama'] = $value['Nm_Unit'];
            $array['total'] = $data;
            //echo $data;
            //$array['pers']=round( ( $data/$total)*100 );
            $array['pers'] = 0;
            $resultData[] = $array;
        }

        usort($resultData, function($a, $b) {
            return $b['total'] - $a['total'];
        });

        return $resultData;
    }

    public function getPaguProgram($Kd_Prog = null) {
        $tahun = date('Y');
        $urusan = Yii::$app->user->identity->id_urusan;
        $bidang = Yii::$app->user->identity->id_bidang;
        $unit = Yii::$app->user->identity->id_skpd;

        $model = TaPaguProgram::find()
                        ->where([
                            'Tahun' => $tahun,
                            'Kd_Urusan' => $urusan,
                            'Kd_Bidang' => $bidang,
                            'Kd_Unit' => $unit,
                            'Kd_Prog' => $Kd_Prog
                        ])->one();

        $return = isset($model) ? $model->pagu : 0;

        return number_format($return, 0, ',', '.');
    }

    public function getPaguProgramAdmin($urusan, $bidang, $unit, $program) {
        $tahun = date('Y');
        $model = TaPaguProgram::find()
                        ->where([
                            'Tahun' => $tahun,
                            'Kd_Urusan' => $urusan,
                            'Kd_Bidang' => $bidang,
                            'Kd_Unit' => $unit,
                            'Kd_Prog' => $program
                        ])->one();

        $return = isset($model) ? $model->pagu : 0;

        return number_format($return, 0, ',', '.');
    }

    public function getListBelanjaCount($Kd_Prog = null, $Kd_Keg = null) {
        $tahun = date('Y');
        $cookies = Yii::$app->request->cookies;

        if (!empty($cookies['skpd'])) {
            $urusan = $cookies['urusan']->value;
            $bidang = $cookies['bidang']->value;
            $unit = $cookies['skpd']->value;
            $sub = $cookies['subUnit']->value;
        } else {
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit = Yii::$app->user->identity->id_skpd;
            $sub = Yii::$app->user->identity->id_subunit;
        }

        // if($sub==0){
        //     $sub=$unit;
        // }

        $model = TaBelanja::find()
                        ->select('Ta_Belanja.*, Ref_Rek_5.Nm_Rek_5')
                        ->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja.Kd_Rek_5
                and Ref_Rek_5.Kd_Rek_1=Ta_Belanja.Kd_Rek_1
                and Ref_Rek_5.Kd_Rek_2=Ta_Belanja.Kd_Rek_2
                and Ref_Rek_5.Kd_Rek_3=Ta_Belanja.Kd_Rek_3
                and Ref_Rek_5.Kd_Rek_4=Ta_Belanja.Kd_Rek_4')
                        ->where([
                            'Tahun' => $tahun,
                            'Kd_Urusan' => $urusan,
                            'Kd_Bidang' => $bidang,
                            'Kd_Unit' => $unit,
                            'Kd_Sub' => $sub,
                            'Kd_Prog' => $Kd_Prog,
                            'Kd_Keg' => $Kd_Keg
                        ])->count();

        return $model;
    }

    public function getCountIndikator($kdprog = null, $kdkeg = null) {

        $tahun = date('Y');
        $cookies = Yii::$app->request->cookies;

        if (!empty($cookies['skpd'])) {
            $urusan = $cookies['urusan']->value;
            $bidang = $cookies['bidang']->value;
            $unit = $cookies['skpd']->value;
            $sub = $cookies['subUnit']->value;
        } else {
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit = Yii::$app->user->identity->id_skpd;
            $sub = Yii::$app->user->identity->id_subunit;
        }

        // if($sub!=0){
        //     $sub=$unit;
        // }

        $model = TaIndikator::find()->where([
                    'Tahun' => $tahun,
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub,
                    'Kd_Prog' => $kdprog,
                    'Kd_Keg' => $kdkeg
                ])->count();

        return $model;
    }

    public function getCountUrusan($kdprog = null, $kdkeg = null) {

        $tahun = date('Y');
        $cookies = Yii::$app->request->cookies;

        if (!empty($cookies['skpd'])) {
            $urusan = $cookies['urusan']->value;
            $bidang = $cookies['bidang']->value;
            $unit = $cookies['skpd']->value;
            $sub = $cookies['subUnit']->value;
        } else {
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit = Yii::$app->user->identity->id_skpd;
            $sub = Yii::$app->user->identity->id_subunit;
        }

        $model = TaKegiatan::find()->where([
                    'Tahun' => $tahun,
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub,
                    'Kd_Prog' => $kdprog,
                    'Kd_Keg' => $kdkeg
                ])->count();

        return $model;
    }

    public function getCountUrusanPeny($kdprog = null, $kdkeg = null) {

        $tahun = date('Y');
        $cookies = Yii::$app->request->cookies;

        if (!empty($cookies['skpd'])) {
            $urusan = $cookies['urusan']->value;
            $bidang = $cookies['bidang']->value;
            $unit = $cookies['skpd']->value;
            $sub = $cookies['urusan']->value;


            $model = TaKegiatan::find()->where([
                        'Tahun' => $tahun,
                        'Kd_Urusan' => $urusan,
                        'Kd_Bidang' => $bidang,
                        'Kd_Unit' => $unit,
                        'Kd_Sub' => $sub,
                        'Kd_Prog' => $kdprog,
                        'Kd_Keg' => $kdkeg
                    ])->count();

            return $model;
        } else {
            return false;
        }
    }

    public function getIndikatorByOne($KdIndikator) {
        $model = RefIndikator::find()->where([
                    'Kd_Indikator' => $KdIndikator
                ])->one();
        return $model;
    }

    public function getSumberDanaByOne($kdSumber) {
        $model = RefSumberDana::find()->where([
                    'Kd_Sumber' => $kdSumber
                ])->one();
        return $model;
    }

    public function getSatuan($id = null) {
        if ($id) {
            $model = Satuan::find()->where([
                        'id' => $id
                    ])->one();
        } else {
            $model = Satuan::find()->all();
        }

        return $model;
    }

    public function getSatuanModel() {
        $model = RefStandardSatuan::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Uraian']] = $d['Uraian'];
        }
        return $data;
    }

    public function getPaguKegiatan($urusan, $bidang, $unit, $sub, $kdprog, $kdkeg) {
        $tahun = date('Y');
        $model = TaKegiatan::find()->where([
                    'Tahun' => $tahun,
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Unit' => $unit,
                    'Kd_Sub' => $sub,
                    'Kd_Prog' => $kdprog,
                    'Kd_Keg' => $kdkeg
                ])->one();

        $return = isset($model) ? $model->Pagu_Anggaran : 0;

        return number_format($return, 0, ',', '.');
    }

    public function getPaguKegiatanAll($urusan, $bidang, $unit, $sub, $kdprog) {

        $tahun = date('Y');
        $query = Yii::$app->db->createCommand('
            SELECT SUM(Pagu_Anggaran) as total FROM Ta_Kegiatan WHERE
            Tahun= ' . $tahun . ' AND
            Kd_Urusan=' . $urusan . ' AND
            Kd_Bidang=' . $bidang . ' AND
            Kd_Unit=' . $unit . ' AND
            Kd_Sub=' . $sub . ' AND
            Kd_Prog=' . $kdprog . '
        ');

        $result = $query->queryAll();

        $return = isset($result) ? $result[0]['total'] : 0;

        return number_format($return, 0, ',', '.');
    }

    public function getPaguSisaKeg($urusan, $bidang, $unit, $sub, $kdprog) {

        $tahun = date('Y');
        $pro = TaPaguProgram::find()
                        ->where([
                            'Tahun' => $tahun,
                            'Kd_Urusan' => $urusan,
                            'Kd_Bidang' => $bidang,
                            'Kd_Unit' => $unit,
                            'Kd_Prog' => $kdprog
                        ])->one();

        $returnPro = isset($pro) ? $pro->pagu : 0;

        $keg = Yii::$app->db->createCommand('
            SELECT SUM(Pagu_Anggaran) as total FROM Ta_Kegiatan WHERE
            Tahun= ' . $tahun . ' AND
            Kd_Urusan=' . $urusan . ' AND
            Kd_Bidang=' . $bidang . ' AND
            Kd_Unit=' . $unit . ' AND
            Kd_Sub=' . $sub . ' AND
            Kd_Prog=' . $kdprog . '
        ');

        $returnkegQ = $keg->queryAll();

        $returnkeg = isset($returnkegQ) ? $returnkegQ[0]['total'] : 0;

        return $returnPro - $returnkeg;
    }

    public function getKeteranganUraian($KdUrusan, $KdBidang, $KdUnit, $kdprog, $kdkeg) {
        $tahun = date('Y');
        $model = TaKegiatan::find()->where([
                    'Tahun' => $tahun,
                    'Kd_Urusan' => $KdUrusan,
                    'Kd_Bidang' => $KdBidang,
                    'Kd_Unit' => $KdUnit,
                    'Kd_Prog' => $kdprog,
                    'Kd_Keg' => $kdkeg
                ])->one();

        if ($model) {
            return $model->Keterangan;
        } else {
            return '';
        }
    }

    public function getDataSubUnitPagu($Kd_Urusan, $Kd_Bidang, $Kd_Unit) {
        $idLevel = Yii::$app->user->identity->id_level;
        $username = Yii::$app->user->identity->username;

        $model = RefSubUnit::find()->select(['Ref_Sub_Unit.*', 'ru.Nm_Urusan namaUrusan', 'rb.Nm_Bidang namaBidang', 'tpu.pagu pagu'])
                ->leftJoin('Ref_Urusan ru', 'ru.Kd_Urusan=Ref_Sub_Unit.Kd_Urusan')
                ->leftJoin('Ref_Bidang rb', 'rb.Kd_Urusan=Ref_Sub_Unit.Kd_Urusan and rb.Kd_Bidang=Ref_Sub_Unit.Kd_Bidang')
                ->leftJoin('Ta_Pagu_Unit tpu', 'tpu.Kd_Urusan=Ref_Sub_Unit.Kd_Urusan and tpu.Kd_Bidang=Ref_Sub_Unit.Kd_Bidang and tpu.Kd_Unit=Ref_Sub_Unit.Kd_Unit and tpu.Kd_Sub=Ref_Sub_Unit.Kd_Sub');

        if ($idLevel == 8) {
            $model->leftJoin('level_unit lu', 'lu.Kd_Urusan=Ref_Sub_Unit.Kd_Urusan and lu.Kd_Bidang=Ref_Sub_Unit.Kd_Bidang and lu.Kd_Unit=Ref_Sub_Unit.Kd_Unit and lu.Kd_Sub=Ref_Sub_Unit.Kd_Sub')
                    ->where(['Ref_Sub_Unit.Kd_Urusan' => $Kd_Urusan, 'Ref_Sub_Unit.Kd_Bidang' => $Kd_Bidang, 'Ref_Sub_Unit.Kd_Unit' => $Kd_Unit, 'username' => $username]);
        } else {
            $model->where(['Ref_Sub_Unit.Kd_Urusan' => $Kd_Urusan, 'Ref_Sub_Unit.Kd_Bidang' => $Kd_Bidang, 'Ref_Sub_Unit.Kd_Unit' => $Kd_Unit]);
        }

        return $model->all();
    }

    public function getSingkronisasiProgram($Kd_Urusan, $Kd_Bidang, $Kd_Program) {
        $model = ProgramNasional::find()->select([
                    'pn.prioritas_nasional as namaPrioritas',
                    'na.nawacita as namaNawacita',
                    'mi.misi as namaMisi',
                    'ur.urusan as namaUrusan'
                ])
                ->leftJoin('nawacita na', 'na.id=program_nasional.id_nawacita')
                ->leftJoin('prioritas_nasional pn', 'pn.id=program_nasional.id_prioritas and pn.id_nawacita=na.id')
                ->leftJoin('misi mi', 'mi.id=program_nasional.id_misi')
                ->leftJoin('urusan ur', 'ur.id=program_nasional.id_urusan and mi.id=ur.idMisi')
                ->where(['program_nasional.urusan' => $Kd_Urusan, 'program_nasional.bidang' => $Kd_Bidang, 'program_nasional.id_program' => $Kd_Program])
        ;
        $model = $model->all();
        $model = isset($model) ? $model[0] : null;
        return $model;
    }

}
