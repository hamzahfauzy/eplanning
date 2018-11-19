<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Kegiatan_Perubahan".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property integer $Kd_Keg
 * @property string $Keterangan
 * @property string $Keterangan_1
 * @property string $Keterangan_31
 * @property string $Keterangan_32
 */
class TaKegiatanPerubahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kegiatan_Perubahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'integer'],
            [['Keterangan', 'Keterangan_1', 'Keterangan_31', 'Keterangan_32'], 'string', 'max' => 255],
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
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Keterangan' => 'Keterangan',
            'Keterangan_1' => 'Keterangan 1',
            'Keterangan_31' => 'Keterangan 31',
            'Keterangan_32' => 'Keterangan 32',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaKegiatanPerubahanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaKegiatanPerubahanQuery(get_called_class());
    }
}
