<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Golongan".
 *
 * @property integer $Kd_Golongan
 * @property string $Nm_Golongan
 *
 * @property RefGolonganRuang[] $refGolonganRuangs
 */
class RefGolongan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Golongan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Golongan'], 'required'],
            [['Kd_Golongan'], 'integer'],
            [['Nm_Golongan'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Golongan' => 'Kd  Golongan',
            'Nm_Golongan' => 'Nm  Golongan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefGolonganRuangs()
    {
        return $this->hasMany(RefGolonganRuang::className(), ['Kd_Golongan' => 'Kd_Golongan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefGolonganQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefGolonganQuery(get_called_class());
    }
}
