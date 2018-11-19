<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ref_Sub_Unit_Apbn".
 *
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property string $Nm_Sub_Unit
 * @property int $Flag
 * @property string $Token
 */
class RefSubUnitApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sub_Unit_Apbn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Nm_Sub_Unit'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Flag'], 'integer'],
            [['Nm_Sub_Unit', 'Token'], 'string', 'max' => 255],
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
            'Kd_Sub' => 'Kd  Sub',
            'Nm_Sub_Unit' => 'Nm  Sub  Unit',
            'Flag' => 'Flag',
            'Token' => 'Token',
        ];
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\RefSubUnitApbnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\RefSubUnitApbnQuery(get_called_class());
    }
}
