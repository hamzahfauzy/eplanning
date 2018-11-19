<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Honor_Sub".
 *
 * @property integer $Kd_Honor
 * @property integer $Kd_Honor_Sub
 * @property string $Nm_Honor_Sub
 *
 * @property RefHonor $kdHonor
 * @property RefHonorSubA[] $refHonorSubAs
 */
class RefHonorSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Honor_Sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Honor', 'Kd_Honor_Sub', 'Nm_Honor_Sub'], 'required'],
            [['Kd_Honor', 'Kd_Honor_Sub'], 'integer'],
            [['Nm_Honor_Sub'], 'string'],
            [['Kd_Honor'], 'exist', 'skipOnError' => true, 'targetClass' => RefHonor::className(), 'targetAttribute' => ['Kd_Honor' => 'Kd_Honor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Honor' => 'Kd  Honor',
            'Kd_Honor_Sub' => 'Kd  Honor  Sub',
            'Nm_Honor_Sub' => 'Nm  Honor  Sub',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHonor()
    {
        return $this->hasOne(RefHonor::className(), ['Kd_Honor' => 'Kd_Honor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHonorSubAs()
    {
        return $this->hasMany(RefHonorSubA::className(), ['Kd_Honor' => 'Kd_Honor', 'Kd_Honor_Sub' => 'Kd_Honor_Sub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHonorSubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHonorSubQuery(get_called_class());
    }
}
