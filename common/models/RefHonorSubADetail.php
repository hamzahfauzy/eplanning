<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Honor_Sub_A_Detail".
 *
 * @property integer $Kd_Honor
 * @property integer $Kd_Honor_Sub
 * @property integer $Kd_Honor_Sub_A
 * @property integer $Kd_Honor_Sub_A_Detail
 * @property string $Nm_Honor_Sub_A_Detail
 *
 * @property RefHonorSubA $kdHonor
 */
class RefHonorSubADetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Honor_Sub_A_Detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A', 'Kd_Honor_Sub_A_Detail', 'Nm_Honor_Sub_A_Detail'], 'required'],
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A', 'Kd_Honor_Sub_A_Detail'], 'integer'],
            [['Nm_Honor_Sub_A_Detail'], 'string', 'max' => 200],
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A'], 'exist', 'skipOnError' => true, 'targetClass' => RefHonorSubA::className(), 'targetAttribute' => ['Kd_Honor' => 'Kd_Honor', 'Kd_Honor_Sub' => 'Kd_Honor_Sub', 'Kd_Honor_Sub_A' => 'Kd_Honor_Sub_A']],
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
            'Kd_Honor_Sub_A_Detail' => 'Kd  Honor  Sub  A  Detail',
            'Nm_Honor_Sub_A_Detail' => 'Nm  Honor  Sub  A  Detail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHonor()
    {
        return $this->hasOne(RefHonorSubA::className(), ['Kd_Honor' => 'Kd_Honor', 'Kd_Honor_Sub' => 'Kd_Honor_Sub', 'Kd_Honor_Sub_A' => 'Kd_Honor_Sub_A']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHonorSubADetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHonorSubADetailQuery(get_called_class());
    }
}
