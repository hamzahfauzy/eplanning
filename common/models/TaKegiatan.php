<?php

namespace common\models;
use emusrenbang\models\TaPaguKegiatan;
use emusrenbang\models\TaPaguKegiatanRancanganAwal;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaIndikator;
use emusrenbang\models\TaBelanja;
use common\models\RefSumberDana;

use emusrenbang\models\Savelog;

use Yii;
// use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "Ta_Kegiatan".
 *
 * @property string $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $ID_Prog
 * @property string $Ket_Kegiatan
 * @property string $Lokasi
 * @property string $Kelompok_Sasaran
 * @property string $Status_Kegiatan 1. baru, 2 lanjutan
 * @property double $Pagu_Anggaran
 * @property string $Waktu_Pelaksanaan
 * @property int $Kd_Sumber
 * @property int $Status
 * @property string $Keterangan
 * @property double $Pagu_Anggaran_Nt1
 * @property int $Verifikasi_Bappeda
 * @property int $Tanggal_Verifikasi_Bappeda
 * @property string $Keterangan_Verifikasi_Bappeda
 *
 * @property TaBelanja[] $taBelanjas
 * @property TaSubUnit $tahun
 * @property TaProgram $tahun0
 * @property TaKegiatanPerubahan $taKegiatanPerubahan
 */
class TaKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'Status_Kegiatan', 'Status', 'Keterangan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Kd_Sumber', 'Status', 'Verifikasi_Bappeda', 'Tanggal_Verifikasi_Bappeda'], 'integer'],
            [['Pagu_Anggaran', 'Pagu_Anggaran_Nt1'], 'number'],
            [['Keterangan', 'Keterangan_Verifikasi_Bappeda'], 'string'],
            [['Ket_Kegiatan', 'Kelompok_Sasaran'], 'string', 'max' => 255],
            [['Lokasi'], 'string', 'max' => 800],
            [['Status_Kegiatan'], 'string', 'max' => 1],
            [['Waktu_Pelaksanaan'], 'string', 'max' => 100],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'exist', 'skipOnError' => true, 'targetClass' => TaSubUnit::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => TaProgram::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'ID_Prog' => 'Id  Prog',
            'Ket_Kegiatan' => 'Ket  Kegiatan',
            'Lokasi' => 'Lokasi',
            'Kelompok_Sasaran' => 'Kelompok  Sasaran',
            'Status_Kegiatan' => 'Status  Kegiatan',
            'Pagu_Anggaran' => 'Pagu  Anggaran',
            'Waktu_Pelaksanaan' => 'Waktu  Pelaksanaan',
            'Kd_Sumber' => 'Kd  Sumber',
            'Status' => 'Status',
            'Keterangan' => 'Keterangan',
            'Pagu_Anggaran_Nt1' => 'Pagu  Anggaran  Nt1',
            'Verifikasi_Bappeda' => 'Verifikasi  Bappeda',
            'Tanggal_Verifikasi_Bappeda' => 'Tanggal  Verifikasi  Bappeda',
            'Keterangan_Verifikasi_Bappeda' => 'Keterangan  Verifikasi  Bappeda',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjas()
    {
        return $this->hasMany(TaBelanja::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getTaBelanja()
    {
        return $this->hasOne(TaBelanja::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getTaIndikators()
    {
        return $this->hasMany(TaIndikator::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaSubUnit::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaKegiatanPerubahan()
    {
        return $this->hasOne(TaKegiatanPerubahan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaKegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaKegiatanQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMisis()
    {
        return $this->hasMany(TaMisi::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTupoks()
    {
        return $this->hasMany(TaTupok::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    } 

    public function getUrusan()
    {
        return $this->hasOne(\common\models\RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getKdBidang()
    {
        return $this->hasOne(\common\models\RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getRefUnit() 
    
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }   

    public function getRefSubUnit() 
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }  

    public function getProgram() 
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    } 

    public function getPagu() 
    {
        return $this->hasOne(TaPaguKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    } 
	
	public function getPagurancanganawal() 
    {
        return $this->hasOne(TaPaguKegiatanRancanganAwal::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    } 

    public function getNamaSub()
    {
        return $this->hasOne(\common\models\RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit', 'Kd_Sub'=>'Kd_Sub']);
    }

    public function getBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getSub()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getUnit()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getIndikator()
    {
        return $this->hasOne(TaIndikator::className(),['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit','Kd_Sub'=>'Kd_Sub', 'Kd_Prog'=>'Kd_Prog', 'Kd_Keg'=>'Kd_Keg']);
    }

    public function getSumber()
    {
        return $this->hasOne(RefSumberDana::className(),['Kd_Sumber' => 'Kd_Sumber']);
    }

    public function getBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getSumberDana()
    {
        return $this->hasOne(RefSumberDana::className(),['Kd_Sumber' => 'Kd_Sumber']);
    }

    public function getTaIndikatorsKinerja()
    {
        return $this->hasOne(TaIndikator::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg'])
		->andOnCondition(['Kd_Indikator' => '3']);//Ditambah oleh RG
    }

    public function getTaPrograms()
    {
        return $this->hasOne(TaProgram::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
	
	public function getRefKegiatans()
    {
        return $this->hasOne(RefKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang','Kd_Prog' => 'Kd_Prog','Kd_Keg' => 'Kd_Keg']);
    }

    public function getTaIndikatorsN1()
    {
        return $this->hasOne(TaIndikator::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg'])
                ->andOnCondition(['Kd_Indikator' => '7']);
    }

    public function getTaBelanjaRincSubMany() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $log = new Savelog();
            $pesan = '';
            $kegiatan = '';
            $tabel = $this->tableName();

            // if ($this->isNewRecord) {
            if(strpos(Yii::$app->controller->action->id, 'tambah') !== false){
                $pesan = 'tambah kegiatan berhasil';
                $kegiatan = 'tambah kegiatan';
            }
            else{
                $pesan = 'ubah kegiatan berhasil';
                $kegiatan = 'ubah kegiatan';
            }

            $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
            return true;
        } 
    }

    public function afterDelete()
    {
        $log = new Savelog();
        $tabel = $this->tableName();
        $pesan = 'hapus kegiatan berhasil';
        $kegiatan = 'hapus kegiatan';

        $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
    }
}
