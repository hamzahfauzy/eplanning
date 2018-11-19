<?php

namespace common\models;
use emusrenbang\models\TaPaguKegiatan;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaIndikator;
use common\models\RefSumberDana;

use Yii;

/**
 * This is the model class for table "Ta_Kegiatan".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $ID_Prog
 * @property string $Ket_Kegiatan
 * @property string $Lokasi
 * @property string $Kelompok_Sasaran
 * @property string $Status_Kegiatan
 * @property double $Pagu_Anggaran
 * @property string $Waktu_Pelaksanaan
 * @property integer $Kd_Sumber
 * @property integer $Status
 * @property string $Keterangan
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
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Ket_Kegiatan', 'Status_Kegiatan', 'Status', 'Keterangan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Kd_Sumber', 'Status'], 'integer'],
            [['Pagu_Anggaran'], 'number'],
            [['Keterangan'], 'string'],
            [['Ket_Kegiatan', 'Kelompok_Sasaran'], 'string', 'max' => 255],
            [['Lokasi'], 'string', 'max' => 800],
            [['Status_Kegiatan'], 'string', 'max' => 1],
            [['Waktu_Pelaksanaan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Bidang',
            'Kd_Prog' => 'Program',
            'Kd_Keg' => 'Kegiatan',
            'Kd_Unit' => 'Unit',
            'Kd_Sub' => 'Sub Unit',
            'ID_Prog' => 'Program',
            'Ket_Kegiatan' => 'Keterangan  Kegiatan',
            'Lokasi' => 'Lokasi',
            'Kelompok_Sasaran' => 'Kelompok  Sasaran',
            'Status_Kegiatan' => 'Status  Kegiatan',
            'Pagu_Anggaran' => 'Pagu  Anggaran',
            'Waktu_Pelaksanaan' => 'Waktu  Pelaksanaan',
            'Kd_Sumber' => 'Sumber Dana',
            'Status' => 'Status',
            'Keterangan' => 'Catatan Penting',
        ];
    }

    /**
     * @inheritdoc
     * @return TaKegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaKegiatanQuery(get_called_class());
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

}
