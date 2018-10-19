<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Bidang_Prov".
 *
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property string $Nm_Bidang
 * @property int $Kd_Fungsi
 * @property int $Flag
 * @property string $Token
 *
 * @property RefUrusanProv $kdUrusan
 * @property RefUnitProv[] $refUnitProvs
 */
class RefBidangProv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Bidang_Prov';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Nm_Bidang', 'Kd_Fungsi'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Fungsi', 'Flag'], 'integer'],
            [['Nm_Bidang', 'Token'], 'string', 'max' => 255],
            [['Kd_Urusan'], 'exist', 'skipOnError' => true, 'targetClass' => RefUrusanProv::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan']],
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
            'Nm_Bidang' => 'Nm  Bidang',
            'Kd_Fungsi' => 'Kd  Fungsi',
            'Flag' => 'Flag',
            'Token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUrusanProv::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUnitProvs()
    {
        return $this->hasMany(RefUnitProv::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefBidangProvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefBidangProvQuery(get_called_class());
    }
}
