<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Level".
 *
 * @property string $Kd_Level
 * @property string $Nm_Level
 */
class RefLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Level'], 'required'],
            [['Kd_Level'], 'string', 'max' => 2],
            [['Nm_Level'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Level' => 'Kd  Level',
            'Nm_Level' => 'Nm  Level',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefLevelQuery(get_called_class());
    }
}
