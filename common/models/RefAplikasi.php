<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Aplikasi".
 *
 * @property string $Kd_Aplikasi
 * @property string $Nm_Aplikasi
 */
class RefAplikasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Aplikasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Aplikasi', 'Nm_Aplikasi'], 'required'],
            [['Kd_Aplikasi', 'Nm_Aplikasi'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Aplikasi' => 'Kd  Aplikasi',
            'Nm_Aplikasi' => 'Nm  Aplikasi',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAplikasiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAplikasiQuery(get_called_class());
    }
}
