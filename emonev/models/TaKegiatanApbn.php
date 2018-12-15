<?php

namespace emonev\models;

use Yii;
use emonev\models\TaBelanjaRincSubApbn;
use emonev\models\TaIndikatorApbn;
use emonev\models\TaBelanjaApbn;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefProgram;
/**
 * This is the model class for table "Ta_Kegiatan_Apbn".
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
 * @property int $Kd_Urusan_Prov 
 * @property int $Kd_Bidang_Prov
 * @property int $Kd_Unit_Prov
 * @property int $Kd_Sub_Prov
 */
class TaKegiatanApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kegiatan_Apbn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'Status_Kegiatan', 'Status', 'Keterangan', 'Kd_Urusan_Prov', 'Kd_Bidang_Prov', 'Kd_Unit_Prov', 'Kd_Sub_Prov'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Kd_Sumber', 'Status', 'Verifikasi_Bappeda', 'Tanggal_Verifikasi_Bappeda', 'Kd_Urusan_Prov', 'Kd_Bidang_Prov', 'Kd_Unit_Prov', 'Kd_Sub_Prov'], 'integer'],
            [['Pagu_Anggaran', 'Pagu_Anggaran_Nt1'], 'number'],
            [['Keterangan', 'Keterangan_Verifikasi_Bappeda'], 'string'],
            [['Ket_Kegiatan', 'Kelompok_Sasaran'], 'string', 'max' => 255],
            [['Lokasi'], 'string', 'max' => 800],
            [['Status_Kegiatan'], 'string', 'max' => 1],
            [['Waktu_Pelaksanaan'], 'string', 'max' => 100],
			           [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => TaProgramApbn::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']],
            [['Kd_Urusan_Prov', 'Kd_Bidang_Prov', 'Kd_Unit_Prov', 'Kd_Sub_Prov'], 'exist', 'skipOnError' => true, 'targetClass' => RefSubUnitApbn::className(), 'targetAttribute' => ['Kd_Urusan_Prov' => 'Kd_Urusan', 'Kd_Bidang_Prov' => 'Kd_Bidang', 'Kd_Unit_Prov' => 'Kd_Unit', 'Kd_Sub_Prov' => 'Kd_Sub']],
  
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
            'Kd_Urusan_Prov' => 'Kd  Urusan  Prov',
            'Kd_Bidang_Prov' => 'Kd  Bidang  Prov',
            'Kd_Unit_Prov' => 'Kd  Unit  Prov',
            'Kd_Sub_Prov' => 'Kd  Sub  Prov',
        ];
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaKegiatanApbnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaKegiatanApbnQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjas()
    {
        return $this->hasMany(TaBelanjaApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaIndikatorApbns()
    {
        return $this->hasMany(TaIndikatorApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaProgramApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusanApbn()
    {
        return $this->hasOne(RefSubUnitApbn::className(), ['Kd_Urusan' => 'Kd_Urusan_Prov', 'Kd_Bidang' => 'Kd_Bidang_Prov', 'Kd_Unit' => 'Kd_Unit_Prov', 'Kd_Sub' => 'Kd_Sub_Prov']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaKegiatanProvQuery the active query used by this AR class.
     */
    
    public function getUrusan()
    {
        return $this->hasOne(\common\models\RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(\common\models\RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getUnit() 
    
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }   

    public function getSub() 
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }  

    public function getProgram() 
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    } 

    public function getBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSubApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }
}

