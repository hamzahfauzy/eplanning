<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Honor_Sub_A".
 *
 * @property integer $Kd_Honor
 * @property integer $Kd_Honor_Sub
 * @property integer $Kd_Honor_Sub_A
 * @property string $Nm_Honor_Sub_A
 *
 * @property RefHonorSub $kdHonor
 * @property RefHonorSubADetail[] $refHonorSubADetails
 */
class RefHonorSubA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Honor_Sub_A';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A', 'Nm_Honor_Sub_A'], 'required'],
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A'], 'integer'],
            [['Nm_Honor_Sub_A'], 'string', 'max' => 200],
            [['Kd_Honor', 'Kd_Honor_Sub'], 'exist', 'skipOnError' => true, 'targetClass' => RefHonorSub::className(), 'targetAttribute' => ['Kd_Honor' => 'Kd_Honor', 'Kd_Honor_Sub' => 'Kd_Honor_Sub']],
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
            'Kd_Honor_Sub_A' => 'Kd  Honor  Sub  A',
            'Nm_Honor_Sub_A' => 'Nm  Honor  Sub  A',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHonor()
    {
        return $this->hasOne(RefHonorSub::className(), ['Kd_Honor' => 'Kd_Honor', 'Kd_Honor_Sub' => 'Kd_Honor_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHonorSubADetails()
    {
        return $this->hasMany(RefHonorSubADetail::className(), ['Kd_Honor' => 'Kd_Honor', 'Kd_Honor_Sub' => 'Kd_Honor_Sub', 'Kd_Honor_Sub_A' => 'Kd_Honor_Sub_A']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHonorSubAQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHonorSubAQuery(get_called_class());
    }
}
