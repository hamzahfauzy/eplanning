<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Honor".
 *
 * @property integer $Kd_Honor
 * @property string $Nm_Honor
 *
 * @property RefHonorSub[] $refHonorSubs
 */
class RefHonor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Honor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nm_Honor'], 'required'],
            [['Nm_Honor'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Honor' => 'Kd  Honor',
            'Nm_Honor' => 'Nm  Honor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHonorSubs()
    {
        return $this->hasMany(RefHonorSub::className(), ['Kd_Honor' => 'Kd_Honor']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHonorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHonorQuery(get_called_class());
    }
}
