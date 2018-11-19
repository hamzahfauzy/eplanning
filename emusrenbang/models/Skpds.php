<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "skpds".
 *
 * @property integer $id
 * @property string $kode_skpd
 * @property string $skpd
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Skpds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skpds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skpd'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode_skpd'], 'string', 'max' => 200],
            [['skpd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_skpd' => 'Kode Skpd',
            'skpd' => 'Skpd',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
