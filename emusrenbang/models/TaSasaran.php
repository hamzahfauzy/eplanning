<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Sasaran".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property string $Ur_Sasaran
 */
class TaSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $urMisi;
    var $urTujuan;
    public static function tableName()
    {
        return 'Ta_Sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Ur_Sasaran'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'integer'],
            [['Ur_Sasaran'], 'string', 'max' => 255],
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
            'Kd_Unit' => 'SKPD',
            'Kd_Sub' => 'UPT',
            'No_Misi' => ' Misi',
            'No_Tujuan' => 'Tujuan',
            'No_Sasaran' => 'Kode Sasaran',
            'Ur_Sasaran' => 'Sasaran',
            'urMisi' => 'Misi',
            'urTujuan' => 'Tujuan'
        ];
    }
}
