<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Tingkat".
 *
 * @property integer $Kd_Tingkat
 * @property string $Nm_Tingkat
 */
class RefTingkat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Tingkat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Tingkat'], 'required'],
            [['Kd_Tingkat'], 'integer'],
            [['Nm_Tingkat'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Tingkat' => 'Kd  Tingkat',
            'Nm_Tingkat' => 'Nm  Tingkat',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefTingkatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefTingkatQuery(get_called_class());
    }
}
