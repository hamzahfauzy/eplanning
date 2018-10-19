<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Sub_Unit_Prov".
 *
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property string $Nm_Sub_Unit
 * @property int $Flag
 * @property string $Token
 *
 * @property RefUnitProv $kdUrusan
 * @property TaKegiatanProv[] $taKegiatanProvs
 */
class RefSubUnitProv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sub_Unit_Prov';
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
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'exist', 'skipOnError' => true, 'targetClass' => RefUnitProv::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUnitProv::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaKegiatanProvs()
    {
        return $this->hasMany(TaKegiatanProv::className(), ['Kd_Urusan_Prov' => 'Kd_Urusan', 'Kd_Bidang_Prov' => 'Kd_Bidang', 'Kd_Unit_Prov' => 'Kd_Unit', 'Kd_Sub_Prov' => 'Kd_Sub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSubUnitProvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSubUnitProvQuery(get_called_class());
    }
}
