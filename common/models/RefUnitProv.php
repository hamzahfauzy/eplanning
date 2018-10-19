<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Unit_Prov".
 *
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property string $Nm_Unit
 * @property int $Flag
 * @property string $Token
 *
 * @property RefSubUnitProv[] $refSubUnitProvs
 * @property RefBidangProv $kdUrusan
 */
class RefUnitProv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Unit_Prov';
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
            [['Kd_Urusan', 'Kd_Bidang'], 'exist', 'skipOnError' => true, 'targetClass' => RefBidangProv::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubUnitProvs()
    {
        return $this->hasMany(RefSubUnitProv::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefBidangProv::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefUnitProvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefUnitProvQuery(get_called_class());
    }
}
