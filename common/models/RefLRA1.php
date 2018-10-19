<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_LRA_1".
 *
 * @property integer $Kd_Rek_1
 * @property string $Nm_Rek_1
 *
 * @property RefLRA2[] $refLRA2s
 */
class RefLRA1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_LRA_1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Nm_Rek_1'], 'required'],
            [['Kd_Rek_1'], 'integer'],
            [['Nm_Rek_1'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Nm_Rek_1' => 'Nm  Rek 1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefLRA2s()
    {
        return $this->hasMany(RefLRA2::className(), ['Kd_Rek_1' => 'Kd_Rek_1']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefLRA1Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefLRA1Query(get_called_class());
    }
}
