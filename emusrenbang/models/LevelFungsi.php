<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level_fungsi".
 *
 * @property integer $id
 * @property string $fungsi
 */
class LevelFungsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level_fungsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fungsi'], 'required'],
            [['fungsi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fungsi' => 'Fungsi',
        ];
    }
}
