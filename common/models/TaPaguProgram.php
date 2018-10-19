<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Pagu_Program".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Prog
 * @property double $pagu
 */
class TaPaguProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pagu_Program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Prog'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Prog'], 'integer'],
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
            'Kd_Unit' => 'Kode Unit',
            'Kd_Prog' => 'Kode Program',
            'pagu' => 'Pagu',
        ];
    }
}
