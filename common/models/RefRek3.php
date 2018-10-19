<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Rek_3".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property string $Nm_Rek_3
 * @property string $SaldoNorm
 *
 * @property RefRek2 $kdRek1
 * @property RefRek4[] $refRek4s
 */
class RefRek3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Rek_3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Nm_Rek_3', 'SaldoNorm'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3'], 'integer'],
            [['Nm_Rek_3'], 'string', 'max' => 100],
            [['SaldoNorm'], 'string', 'max' => 1],
            [['Kd_Rek_1', 'Kd_Rek_2'], 'exist', 'skipOnError' => true, 'targetClass' => RefRek2::className(), 'targetAttribute' => ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Nm_Rek_3' => 'Nm  Rek 3',
            'SaldoNorm' => 'Saldo Norm',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdRek1()
    {
        return $this->hasOne(RefRek2::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRek4s()
    {
        return $this->hasMany(RefRek4::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefRek3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefRek3Query(get_called_class());
    }
}
