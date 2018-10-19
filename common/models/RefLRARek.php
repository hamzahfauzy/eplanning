<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_LRA_Rek".
 *
 * @property integer $Kd_LRA_1
 * @property integer $Kd_LRA_2
 * @property integer $Kd_LRA_3
 * @property integer $Kd_LRA_4
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 */
class RefLRARek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_LRA_Rek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_LRA_1', 'Kd_LRA_2', 'Kd_LRA_3', 'Kd_LRA_4', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4'], 'required'],
            [['Kd_LRA_1', 'Kd_LRA_2', 'Kd_LRA_3', 'Kd_LRA_4', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_LRA_1' => 'Kd  Lra 1',
            'Kd_LRA_2' => 'Kd  Lra 2',
            'Kd_LRA_3' => 'Kd  Lra 3',
            'Kd_LRA_4' => 'Kd  Lra 4',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefLRARekQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefLRARekQuery(get_called_class());
    }
}
