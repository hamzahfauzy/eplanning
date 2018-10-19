<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Tujuan".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property string $Ur_Tujuan
 */
class TaTujuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    var $urMisi;
    public static function tableName()
    {
        return 'Ta_Tujuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'Ur_Tujuan'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan'], 'integer'],
            [['Ur_Tujuan'], 'string', 'max' => 255],
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
            'No_Misi' => 'Misi',
            'urMisi' => 'Misi',
            'No_Tujuan' => 'Kode Tujuan',
            'Ur_Tujuan' => 'Tujuan',
        ];
    }
}
