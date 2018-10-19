<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Penilaian_Kegiatan".
 *
 * @property string $tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property string $Kd_Unit
 * @property integer $Kd_Program
 * @property string $Kd_Kegiatan
 * @property integer $ID_Penilaian
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 * @property integer $status
 * @property string $created_status
 * @property string $updated_status
 * @property string $status_by
 */
class TaPenilaianKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Penilaian_Kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Program', 'Kd_Kegiatan', 'ID_Penilaian', 'created_at', 'updated_at', 'username', 'created_status', 'updated_status', 'status_by'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Program', 'ID_Penilaian', 'status'], 'integer'],
            [['created_at', 'updated_at', 'created_status', 'updated_status'], 'safe'],
            [['tahun'], 'string', 'max' => 4],
            [['Kd_Unit', 'Kd_Kegiatan'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 100],
            [['status_by'], 'string', 'max' => 200],
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
            'Kd_Program' => 'Kd  Program',
            'Kd_Kegiatan' => 'Kd  Kegiatan',
            'ID_Penilaian' => 'Id  Penilaian',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
            'status' => 'Status',
            'created_status' => 'Created Status',
            'updated_status' => 'Updated Status',
            'status_by' => 'Status By',
        ];
    }
}
