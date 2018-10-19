<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Akrual_5".
 *
 * @property integer $Kd_Akrual_1
 * @property integer $Kd_Akrual_2
 * @property integer $Kd_Akrual_3
 * @property integer $Kd_Akrual_4
 * @property integer $Kd_Akrual_5
 * @property string $Nm_Akrual_5
 * @property string $Peraturan
 *
 * @property RefAkrual4 $kdAkrual1
 */
class RefAkrual5 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Akrual_5';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5', 'Nm_Akrual_5'], 'required'],
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5'], 'integer'],
            [['Nm_Akrual_5'], 'string', 'max' => 255],
            [['Peraturan'], 'string', 'max' => 50],
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4'], 'exist', 'skipOnError' => true, 'targetClass' => RefAkrual4::className(), 'targetAttribute' => ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2', 'Kd_Akrual_3' => 'Kd_Akrual_3', 'Kd_Akrual_4' => 'Kd_Akrual_4']],
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
            'Kd_Akrual_5' => 'Kd  Akrual 5',
            'Nm_Akrual_5' => 'Nm  Akrual 5',
            'Peraturan' => 'Peraturan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAkrual1()
    {
        return $this->hasOne(RefAkrual4::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1', 'Kd_Akrual_2' => 'Kd_Akrual_2', 'Kd_Akrual_3' => 'Kd_Akrual_3', 'Kd_Akrual_4' => 'Kd_Akrual_4']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAkrual5Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAkrual5Query(get_called_class());
    }
}
