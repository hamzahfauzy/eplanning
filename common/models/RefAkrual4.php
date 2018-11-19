<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Akrual_4".
 *
 * @property integer $Kd_Akrual_1
 * @property integer $Kd_Akrual_2
 * @property integer $Kd_Akrual_3
 * @property integer $Kd_Akrual_4
 * @property string $Nm_Akrual_4
 *
 * @property RefAkrual3 $kdAkrual1
 * @property RefAkrual5[] $refAkrual5s
 */
class RefAkrual4 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Akrual_4';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Nm_Akrual_4'], 'required'],
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4'], 'integer'],
            [['Nm_Akrual_4'], 'string', 'max' => 255],
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3'], 'exist', 'skipOnError' => true, 'targetClass' => RefAkrual3::className(), 'targetAttribute' => ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2', 'Kd_Akrual_3' => 'Kd_Akrual_3']],
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
            'Kd_Akrual_4' => 'Kd  Akrual 4',
            'Nm_Akrual_4' => 'Nm  Akrual 4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAkrual1()
    {
        return $this->hasOne(RefAkrual3::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2', 'Kd_Akrual_3' => 'Kd_Akrual_3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAkrual5s()
    {
        return $this->hasMany(RefAkrual5::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2', 'Kd_Akrual_3' => 'Kd_Akrual_3', 'Kd_Akrual_4' => 'Kd_Akrual_4']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAkrual4Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAkrual4Query(get_called_class());
    }
}
