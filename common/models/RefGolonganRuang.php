<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Golongan_Ruang".
 *
 * @property integer $Kd_Golongan
 * @property integer $Kd_Golongan_Ruang
 * @property string $Nm_Golongan_Ruang
 *
 * @property RefGolongan $kdGolongan
 * @property RefPangkat[] $refPangkats
 */
class RefGolonganRuang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Golongan_Ruang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Golongan', 'Kd_Golongan_Ruang'], 'required'],
            [['Kd_Golongan', 'Kd_Golongan_Ruang'], 'integer'],
            [['Nm_Golongan_Ruang'], 'string', 'max' => 5],
            [['Kd_Golongan'], 'exist', 'skipOnError' => true, 'targetClass' => RefGolongan::className(), 'targetAttribute' => ['Kd_Golongan' => 'Kd_Golongan']],
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
            'Nm_Golongan_Ruang' => 'Nm  Golongan  Ruang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdGolongan()
    {
        return $this->hasOne(RefGolongan::className(), ['Kd_Golongan' => 'Kd_Golongan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPangkats()
    {
        return $this->hasMany(RefPangkat::className(), ['Kd_Golongan' => 'Kd_Golongan', 'Kd_Golongan_Ruang' => 'Kd_Golongan_Ruang']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefGolonganRuangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefGolonganRuangQuery(get_called_class());
    }
}
