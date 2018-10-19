<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Kalender_Layout".
 *
 * @property string $Tahun
 * @property integer $Kd_Kalender
 * @property string $Layout
 *
 * @property TaKalender $kdKalender
 */
class TaKalenderLayout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kalender_Layout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Kalender', 'Layout'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Kalender'], 'integer'],
            [['Layout'], 'string', 'max' => 64],
            [['Kd_Kalender'], 'exist', 'skipOnError' => true, 'targetClass' => TaKalender::className(), 'targetAttribute' => ['Kd_Kalender' => 'Kd_Kalender']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Kalender' => 'Kd  Kalender',
            'Layout' => 'Layout',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdKalender()
    {
        return $this->hasOne(TaKalender::className(), ['Kd_Kalender' => 'Kd_Kalender']);
    }
}
