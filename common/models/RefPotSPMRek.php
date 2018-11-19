<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Pot_SPM_Rek".
 *
 * @property integer $Kd_Pot_Rek
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property integer $Kd_Rek_5
 * @property integer $Kd_Pot
 */
class RefPotSPMRek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Pot_SPM_Rek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Pot_Rek', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Pot'], 'required'],
            [['Kd_Pot_Rek', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Pot'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Pot_Rek' => 'Kd  Pot  Rek',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'Kd_Pot' => 'Kd  Pot',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefPotSPMRekQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefPotSPMRekQuery(get_called_class());
    }
}
