<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Forum_Lingkungan".
 *
 * @property integer $Kd_Forum_Lingkungan
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub_Unit
 * @property integer $Kd_Lingkungan
 * @property integer $Kd_Jalan
 * @property integer $Kd_Program
 * @property integer $Kd_Kegiatan
 * @property integer $Kd_Klasifikasi
 * @property integer $Kd_Jenis_Usulan
 * @property string $Nm_Permasalahan
 * @property string $Volume
 * @property integer $Kd_Satuan
 */
class TaForumLingkungan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Forum_Lingkungan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Forum_Lingkungan', 'Kd_Unit', 'Kd_Sub_Unit', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Program', 'Kd_Kegiatan', 'Kd_Klasifikasi', 'Kd_Jenis_Usulan', 'Nm_Permasalahan', 'Volume', 'Kd_Satuan'], 'required'],
            [['Kd_Forum_Lingkungan', 'Kd_Unit', 'Kd_Sub_Unit', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Program', 'Kd_Kegiatan', 'Kd_Klasifikasi', 'Kd_Jenis_Usulan', 'Kd_Satuan'], 'integer'],
            [['Nm_Permasalahan'], 'string', 'max' => 255],
            [['Volume'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Forum_Lingkungan' => 'Kd  Forum  Lingkungan',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub_Unit' => 'Kd  Sub  Unit',
            'Kd_Lingkungan' => 'Kd  Lingkungan',
            'Kd_Jalan' => 'Kd  Jalan',
            'Kd_Program' => 'Kd  Program',
            'Kd_Kegiatan' => 'Kd  Kegiatan',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Kd_Jenis_Usulan' => 'Kd  Jenis  Usulan',
            'Nm_Permasalahan' => 'Nm  Permasalahan',
            'Volume' => 'Volume',
            'Kd_Satuan' => 'Kd  Satuan',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaForumLingkunganQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaForumLingkunganQuery(get_called_class());
    }
}
