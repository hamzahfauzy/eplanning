<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Akrual_2".
 *
 * @property integer $Kd_Akrual_1
 * @property integer $Kd_Akrual_2
 * @property string $Nm_Akrual_2
 *
 * @property RefAkrual1 $kdAkrual1
 * @property RefAkrual3[] $refAkrual3s
 */
class RefAkrual2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Akrual_2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Nm_Akrual_2'], 'required'],
            [['Kd_Akrual_1', 'Kd_Akrual_2'], 'integer'],
            [['Nm_Akrual_2'], 'string', 'max' => 100],
            [['Kd_Akrual_1'], 'exist', 'skipOnError' => true, 'targetClass' => RefAkrual1::className(), 'targetAttribute' => ['Kd_Akrual_1' => 'Kd_Akrual_1']],
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
            'Nm_Akrual_2' => 'Nm  Akrual 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAkrual1()
    {
        return $this->hasOne(RefAkrual1::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAkrual3s()
    {
        return $this->hasMany(RefAkrual3::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAkrual2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAkrual2Query(get_called_class());
    }
}
