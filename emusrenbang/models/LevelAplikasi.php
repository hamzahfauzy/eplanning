<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level_aplikasi".
 *
 * @property integer $id
 * @property string $aplikasi
 */
class LevelAplikasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level_aplikasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aplikasi'], 'required'],
            [['aplikasi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aplikasi' => 'Aplikasi',
        ];
    }
}
