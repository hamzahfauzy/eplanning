<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Country".
 *
 * @property integer $Kd_Benua
 * @property integer $Kd_Benua_Sub
 * @property integer $Kd_Benua_Sub_Negara
 * @property string $Nm_Negara
 *
 * @property RefBenuaSub $kdBenua
 * @property RefProvinsi[] $refProvinsis
 */
class RefCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara'], 'required'],
            [['Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara'], 'integer'],
            [['Nm_Negara'], 'string', 'max' => 100],
            [['Kd_Benua', 'Kd_Benua_Sub'], 'exist', 'skipOnError' => true, 'targetClass' => RefBenuaSub::className(), 'targetAttribute' => ['Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Benua' => 'Kd  Benua',
            'Kd_Benua_Sub' => 'Kd  Benua  Sub',
            'Kd_Benua_Sub_Negara' => 'Kd  Benua  Sub  Negara',
            'Nm_Negara' => 'Nm  Negara',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSubBenua()
    {
        return $this->hasOne(RefBenuaSub::className(), ['Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProvinsis()
    {
        return $this->hasMany(RefProvinsi::className(), ['Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara' => 'Kd_Benua_Sub_Negara']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefCountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefCountryQuery(get_called_class());
    }
}
