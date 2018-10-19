<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level_assignment".
 *
 * @property string $username
 * @property integer $id_level_aplikasi
 * @property integer $id_level_fungsi
 */
class LevelAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'id_level_aplikasi', 'id_level_fungsi'], 'required'],
            [['id_level_aplikasi', 'id_level_fungsi'], 'integer'],
            [['username'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'id_level_aplikasi' => 'Id Level Aplikasi',
            'id_level_fungsi' => 'Id Level Fungsi',
        ];
    }
}
