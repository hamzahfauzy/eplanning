<?php

namespace userlevel\models;

use Yii;

/**
 * This is the model class for table "ta_user_level".
 *
 * @property integer $Kd_User
 * @property integer $Kd_Level
 */
class TaUserLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_User_Level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User', 'Kd_Level'], 'required'],
            [['Kd_User', 'Kd_Level'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'Kd  User',
            'Kd_Level' => 'Kd  Level',
        ];
    }
}
