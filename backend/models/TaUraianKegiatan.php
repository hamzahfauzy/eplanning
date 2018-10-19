<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Uraian_Kegiatan".
 *
 * @property string $tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 * @property string $lokasi_Kegiatan
 * @property string $kelompok_sasaran
 * @property string $waktu_pelaksanaan
 * @property string $status_kegiatan
 * @property double $pagu
 * @property string $sumber_dana
 * @property string $DAK
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 */
class TaUraianKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Uraian_Kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Prog', 'Kd_Keg', 'lokasi_Kegiatan', 'kelompok_sasaran', 'waktu_pelaksanaan', 'status_kegiatan', 'pagu', 'sumber_dana', 'DAK', 'created_at', 'updated_at', 'username'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Prog', 'Kd_Keg'], 'integer'],
            [['pagu'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['tahun'], 'string', 'max' => 4],
            [['lokasi_Kegiatan', 'kelompok_sasaran'], 'string', 'max' => 200],
            [['waktu_pelaksanaan', 'username'], 'string', 'max' => 100],
            [['status_kegiatan'], 'string', 'max' => 20],
            [['sumber_dana'], 'string', 'max' => 30],
            [['DAK'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'lokasi_Kegiatan' => 'Lokasi  Kegiatan',
            'kelompok_sasaran' => 'Kelompok Sasaran',
            'waktu_pelaksanaan' => 'Waktu Pelaksanaan',
            'status_kegiatan' => 'Status Kegiatan',
            'pagu' => 'Pagu',
            'sumber_dana' => 'Sumber Dana',
            'DAK' => 'Dak',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaUraianKegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaUraianKegiatanQuery(get_called_class());
    }
}
