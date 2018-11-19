<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Pangkat".
 *
 * @property integer $Kd_Golongan
 * @property integer $Kd_Golongan_Ruang
 * @property integer $Kd_Pangkat
 * @property string $Nm_Pangkat
 *
 * @property RefGolonganRuang $kdGolongan
 */
class RefPangkat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Pangkat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Golongan', 'Kd_Golongan_Ruang', 'Kd_Pangkat'], 'required'],
            [['Kd_Golongan', 'Kd_Golongan_Ruang', 'Kd_Pangkat'], 'integer'],
            [['Nm_Pangkat'], 'string', 'max' => 25],
            [['Kd_Golongan', 'Kd_Golongan_Ruang'], 'exist', 'skipOnError' => true, 'targetClass' => RefGolonganRuang::className(), 'targetAttribute' => ['Kd_Golongan' => 'Kd_Golongan', 'Kd_Golongan_Ruang' => 'Kd_Golongan_Ruang']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Golongan' => 'Kd  Golongan',
            'Kd_Golongan_Ruang' => 'Kd  Golongan  Ruang',
            'Kd_Pangkat' => 'Kd  Pangkat',
            'Nm_Pangkat' => 'Nm  Pangkat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdGolongan()
    {
        return $this->hasOne(RefGolonganRuang::className(), ['Kd_Golongan' => 'Kd_Golongan', 'Kd_Golongan_Ruang' => 'Kd_Golongan_Ruang']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefPangkatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefPangkatQuery(get_called_class());
    }
}
