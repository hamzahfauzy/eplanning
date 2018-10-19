<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Tupok".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Tupok
 * @property string $Ur_Tupok
 */
class TaTupok extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Tupok';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Tupok', 'Ur_Tupok'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Tupok'], 'integer'],
            [['Ur_Tupok'], 'string', 'max' => 255],
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
            'No_Tupok' => 'No  Tupok',
            'Ur_Tupok' => 'Ur  Tupok',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaTupokQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaTupokQuery(get_called_class());
    }
}
