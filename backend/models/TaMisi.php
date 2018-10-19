<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Misi".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property string $Ur_Misi
 */
class TaMisi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Misi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'Ur_Misi'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi'], 'integer'],
            [['Ur_Misi'], 'string', 'max' => 255],
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
            'No_Misi' => 'No  Misi',
            'Ur_Misi' => 'Ur  Misi',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaMisiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaMisiQuery(get_called_class());
    }
}
