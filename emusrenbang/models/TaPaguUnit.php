<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Pagu_Unit".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property double $pagu
 */
class TaPaguUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pagu_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'integer'],
            [['pagu'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kode Urusan',
            'Kd_Bidang' => 'Kode Sektor',
            'Kd_Unit' => 'Kode SKPD',
            'pagu' => 'Pagu Indikatif SKPD',
        ];
    }
}
