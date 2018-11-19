<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Akrual_1".
 *
 * @property integer $Kd_Akrual_1
 * @property string $Nm_Akrual_1
 *
 * @property RefAkrual2[] $refAkrual2s
 */
class RefAkrual1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Akrual_1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1', 'Nm_Akrual_1'], 'required'],
            [['Kd_Akrual_1'], 'integer'],
            [['Nm_Akrual_1'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Akrual_1' => 'Kd  Akrual 1',
            'Nm_Akrual_1' => 'Nm  Akrual 1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAkrual2s()
    {
        return $this->hasMany(RefAkrual2::className(), ['Kd_Akrual_1' => 'Kd_Akrual_1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAkrual1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAkrual1Query(get_called_class());
    }
}
