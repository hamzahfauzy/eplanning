<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Pot_SPM".
 *
 * @property integer $Kd_Pot
 * @property string $Nm_Pot
 * @property string $Kd_MAP
 */
class RefPotSPM extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Pot_SPM';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Pot', 'Nm_Pot'], 'required'],
            [['Kd_Pot'], 'integer'],
            [['Nm_Pot'], 'string', 'max' => 50],
            [['Kd_MAP'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Pot' => 'Kd  Pot',
            'Nm_Pot' => 'Nm  Pot',
            'Kd_MAP' => 'Kd  Map',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefPotSPMQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefPotSPMQuery(get_called_class());
    }
}
