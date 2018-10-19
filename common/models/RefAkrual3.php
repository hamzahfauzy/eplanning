<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Akrual_3".
 *
 * @property integer $Kd_Akrual_1
 * @property integer $Kd_Akrual_2
 * @property integer $Kd_Akrual_3
 * @property string $Nm_Akrual_3
 * @property string $SaldoNorm
 *
 * @property RefAkrual2 $kdAkrual1
 * @property RefAkrual4[] $refAkrual4s
 */
class RefAkrual3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Akrual_3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Nm_Akrual_3', 'SaldoNorm'], 'required'],
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3'], 'integer'],
            [['Nm_Akrual_3'], 'string', 'max' => 100],
            [['SaldoNorm'], 'string', 'max' => 1],
            [['Kd_Akrual_1', 'Kd_Akrual_2'], 'exist', 'skipOnError' => true, 'targetClass' => RefAkrual2::className(), 'targetAttribute' => ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Akrual_1' => 'Kd  Akrual 1',
            'Kd_Akrual_2' => 'Kd  Akrual 2',
            'Kd_Akrual_3' => 'Kd  Akrual 3',
            'Nm_Akrual_3' => 'Nm  Akrual 3',
            'SaldoNorm' => 'Saldo Norm',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAkrual1()
    {
        return $this->hasOne(RefAkrual2::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAkrual4s()
    {
        return $this->hasMany(RefAkrual4::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2', 'Kd_Akrual_3' => 'Kd_Akrual_3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAkrual3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAkrual3Query(get_called_class());
    }
}
