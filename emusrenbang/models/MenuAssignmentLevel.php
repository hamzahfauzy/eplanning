<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_assignment_level".
 *
 * @property string $level
 * @property integer $id_menu
 */
class MenuAssignmentLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $NmLevel;
    public static function tableName()
    {
        return 'menu_assignment_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'id_menu'], 'required'],
            [['id_menu'], 'integer'],
            [['level'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'level' => 'Level',
            'id_menu' => 'Id Menu',
        ];
    }
}
