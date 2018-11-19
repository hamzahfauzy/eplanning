<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Kalender".
 *
 * @property integer $Kd_Kalender
 * @property string $Tahun
 * @property string $Waktu_Mulai
 * @property string $Waktu_Selesai
 * @property string $Keterangan
 *
 * @property TaKalenderLayout[] $taKalenderLayouts
 */
class TaKalender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kalender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Kalender', 'Tahun', 'Keterangan'], 'required'],
            [['Kd_Kalender'], 'integer'],
            [['Tahun', 'Waktu_Mulai', 'Waktu_Selesai'], 'safe'],
            [['Keterangan'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Kalender' => 'Kd  Kalender',
            'Tahun' => 'Tahun',
            'Waktu_Mulai' => 'Waktu  Mulai',
            'Waktu_Selesai' => 'Waktu  Selesai',
            'Keterangan' => 'Subjek',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaKalenderLayouts()
    {
        return $this->hasMany(TaKalenderLayout::className(), ['Kd_Kalender' => 'Kd_Kalender']);
    }
}
