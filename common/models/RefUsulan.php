<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Usulan".
 *
 * @property integer $Kd_Usulan
 * @property integer $Kd_Klasifikasi
 * @property string $Nm_Usulan
 *
 * @property RefKlasifikasiUsulan $kdKlasifikasi
 */
class RefUsulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Usulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Usulan', 'Kd_Klasifikasi', 'Nm_Usulan'], 'required'],
            [['Kd_Usulan', 'Kd_Klasifikasi'], 'integer'],
            [['Nm_Usulan'], 'string', 'max' => 255],
            [['Kd_Klasifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => RefKlasifikasiUsulan::className(), 'targetAttribute' => ['Kd_Klasifikasi' => 'Kd_Klasifikasi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Usulan' => 'Kd  Usulan',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Nm_Usulan' => 'Nm  Usulan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdKlasifikasi()
    {
        return $this->hasOne(RefKlasifikasiUsulan::className(), ['Kd_Klasifikasi' => 'Kd_Klasifikasi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefUsulanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefUsulanQuery(get_called_class());
    }
}
