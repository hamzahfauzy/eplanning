<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jabatans".
 *
 * @property integer $id
 * @property string $jabatan
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Jabatans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jabatans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jabatan'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['jabatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jabatan' => 'Jabatan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
