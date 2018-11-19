<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ket_Biaya".
 *
 * @property integer $Kd_Ket_Biaya
 * @property string $Nm_Ket_Biaya
 */
class RefKetBiaya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ket_Biaya';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ket_Biaya'], 'required'],
            [['Kd_Ket_Biaya'], 'integer'],
            [['Nm_Ket_Biaya'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Ket_Biaya' => 'Kd  Ket  Biaya',
            'Nm_Ket_Biaya' => 'Nm  Ket  Biaya',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKetBiayaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKetBiayaQuery(get_called_class());
    }
}
