<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kegiatan_skpd".
 *
 * @property string $tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property string $Kd_Unit
 * @property integer $Kd_Program
 * @property string $Kd_Kegiatan
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 */
class KegiatanSkpd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
   public $id_prioritas;
   public $nawacita;
   public $id_nawacita;
   public $id_urusan;
   public $misi;
   public $id_misi;
    public static function tableName()
    {
        return 'kegiatan_skpd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Program', 'Kd_Kegiatan', 'created_at', 'updated_at', 'username'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Program'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tahun'], 'string', 'max' => 4],
            [['Kd_Unit', 'Kd_Kegiatan'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tahun' => 'Tahun',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Sektor',
            'Kd_Unit' => 'SKPD',
            'Kd_Program' => 'Program',
            'Kd_Kegiatan' => 'Kegiatan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
        ];
    }
}
