<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_assignment".
 *
 * @property string $username
 * @property integer $id_menu
 */
class MenuAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'id_menu'], 'required'],
            [['id_menu'], 'integer'],
            [['username'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'id_menu' => 'Id Menu',
        ];
    }
}
