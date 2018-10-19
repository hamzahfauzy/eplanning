<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "levels".
 *
 * @property integer $id
 * @property string $level
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Levels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'levels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['level'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
