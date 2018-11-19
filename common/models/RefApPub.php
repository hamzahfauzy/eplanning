<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ap_Pub".
 *
 * @property int $Kd_Ap_Pub
 * @property string $Nm_Ap_Pub
 *
 * @property TaBelanja[] $taBelanjas
 */
class RefApPub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ap_Pub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ap_Pub', 'Nm_Ap_Pub'], 'required'],
            [['Kd_Ap_Pub'], 'integer'],
            [['Nm_Ap_Pub'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Ap_Pub' => 'Kd  Ap  Pub',
            'Nm_Ap_Pub' => 'Nm  Ap  Pub',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjas()
    {
        return $this->hasMany(TaBelanja::className(), ['Kd_Ap_Pub' => 'Kd_Ap_Pub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefApPubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefApPubQuery(get_called_class());
    }
}
