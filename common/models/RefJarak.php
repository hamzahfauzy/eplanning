<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jarak".
 *
 * @property integer $Kd_Jarak
 * @property string $Nm_Jarak
 */
class RefJarak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jarak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jarak'], 'required'],
            [['Kd_Jarak'], 'integer'],
            [['Nm_Jarak'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Jarak' => 'Kd  Jarak',
            'Nm_Jarak' => 'Nm  Jarak',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJarakQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJarakQuery(get_called_class());
    }
}
