<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Benua_Sub".
 *
 * @property integer $Kd_Benua
 * @property integer $Kd_Benua_Sub
 * @property string $Nm_Benua_Sub
 *
 * @property RefBenua $kdBenua
 * @property RefCountry[] $refCountries
 */
class RefBenuaSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Benua_Sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Benua', 'Kd_Benua_Sub'], 'required'],
            [['Kd_Benua', 'Kd_Benua_Sub'], 'integer'],
            [['Nm_Benua_Sub'], 'string', 'max' => 100],
            [['Kd_Benua'], 'exist', 'skipOnError' => true, 'targetClass' => RefBenua::className(), 'targetAttribute' => ['Kd_Benua' => 'Kd_Benua']],
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
            'Nm_Benua_Sub' => 'Nm  Benua  Sub',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdBenua()
    {
        return $this->hasOne(RefBenua::className(), ['Kd_Benua' => 'Kd_Benua']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCountries()
    {
        return $this->hasMany(RefCountry::className(), ['Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefBenuaSubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefBenuaSubQuery(get_called_class());
    }
}
