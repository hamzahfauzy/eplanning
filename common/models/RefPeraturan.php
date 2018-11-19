<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Peraturan".
 *
 * @property int $Kd_Peraturan
 * @property string $Nm_Peraturan
 *
 * @property TaPeraturan[] $taPeraturans
 */
class RefPeraturan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Peraturan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Peraturan', 'Nm_Peraturan'], 'required'],
            [['Kd_Peraturan'], 'integer'],
            [['Nm_Peraturan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Peraturan' => 'Kd  Peraturan',
            'Nm_Peraturan' => 'Nm  Peraturan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPeraturans()
    {
        return $this->hasMany(TaPeraturan::className(), ['Kd_Peraturan' => 'Kd_Peraturan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefPeraturanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefPeraturanQuery(get_called_class());
    }
}
