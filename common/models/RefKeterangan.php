<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Keterangan".
 *
 * @property integer $Kd_Keterangan
 * @property string $Nm_Keterangan
 */
class RefKeterangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Keterangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Keterangan'], 'required'],
            [['Kd_Keterangan'], 'integer'],
            [['Nm_Keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Keterangan' => 'Kd  Keterangan',
            'Nm_Keterangan' => 'Nm  Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKeteranganQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKeteranganQuery(get_called_class());
    }
}
