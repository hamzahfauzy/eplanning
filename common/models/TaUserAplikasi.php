<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_User_Aplikasi".
 *
 * @property integer $Kd_User
 * @property string $Kd_Aplikasi
 */
class TaUserAplikasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_User_Aplikasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User', 'Kd_Aplikasi'], 'required'],
            [['Kd_User'], 'integer'],
            [['Kd_Aplikasi'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'Kd  User',
            'Kd_Aplikasi' => 'Kd  Aplikasi',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaUserAplikasiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaUserAplikasiQuery(get_called_class());
    }
}
