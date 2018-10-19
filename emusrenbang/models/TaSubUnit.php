<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Sub_Unit".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $Nm_Pimpinan
 * @property string $Nip_Pimpinan
 * @property string $Jbt_Pimpinan
 * @property string $Alamat
 * @property string $Ur_Visi
 */
class TaSubUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Sub_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Pimpinan'], 'string', 'max' => 50],
            [['Nip_Pimpinan'], 'string', 'max' => 21],
            [['Jbt_Pimpinan'], 'string', 'max' => 75],
            [['Alamat', 'Ur_Visi'], 'string', 'max' => 255],
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
            'Kd_Bidang' => 'Sektor',
            'Kd_Unit' => 'OPD',
            'Kd_Sub' => 'UPT',
            'Nm_Pimpinan' => 'Nama Pimpinan',
            'Nip_Pimpinan' => 'Nip  Pimpinan',
            'Jbt_Pimpinan' => 'Jabatan Pimpinan',
            'Alamat' => 'Alamat',
            'Ur_Visi' => 'Visi',
        ];
    }
}
