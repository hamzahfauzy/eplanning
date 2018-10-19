<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ref_Unit_Apbn".
 *
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property string $Nm_Unit
 * @property int $Flag
 * @property string $Token
 */
class RefUnitApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Unit_Apbn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Nm_Unit'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Flag'], 'integer'],
            [['Nm_Unit', 'Token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Nm_Unit' => 'Nm  Unit',
            'Flag' => 'Flag',
            'Token' => 'Token',
        ];
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\RefUnitApbnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\RefUnitApbnQuery(get_called_class());
    }
}
