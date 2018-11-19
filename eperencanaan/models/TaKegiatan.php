<?php

namespace eperencanaan\models;

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

    
}
