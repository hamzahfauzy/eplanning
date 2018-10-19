<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Sumber_Dana".
 *
 * @property int $Kd_Sumber
 * @property string $Nm_Sumber
 *
 * @property TaBelanja[] $taBelanjas
 * @property TaBelanjaRinc[] $taBelanjaRincs
 */
class RefSumberDana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sumber_Dana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Sumber', 'Nm_Sumber'], 'required'],
            [['Kd_Sumber'], 'integer'],
            [['Nm_Sumber'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Sumber' => 'Kd  Sumber',
            'Nm_Sumber' => 'Nm  Sumber',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjas()
    {
        return $this->hasMany(TaBelanja::className(), ['Kd_Sumber' => 'Kd_Sumber']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjaRincs()
    {
        return $this->hasMany(TaBelanjaRinc::className(), ['Kd_Sumber' => 'Kd_Sumber']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSumberDanaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSumberDanaQuery(get_called_class());
    }
}
