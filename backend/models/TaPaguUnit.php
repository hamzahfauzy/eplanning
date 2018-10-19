<?php

namespace backend\models;

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
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'pagu' => 'Pagu',
        ];
    }


    /**
     * @inheritdoc
     * @return \backend\models\query\TaPaguUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPaguUnitQuery(get_called_class());
    }
}
