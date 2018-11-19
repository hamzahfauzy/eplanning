<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Sasaran".
 *
 * @property integer $Kd_Sasaran
 * @property string $Nm_Sasaran
 */
class RefSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Sasaran', 'Nm_Sasaran'], 'required'],
            [['Kd_Sasaran'], 'integer'],
            [['Nm_Sasaran'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Sasaran' => 'Kd  Sasaran',
            'Nm_Sasaran' => 'Sasaran',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSasaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSasaranQuery(get_called_class());
    }
}
