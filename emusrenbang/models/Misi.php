<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "misi".
 *
 * @property integer $id
 * @property string $misi
 */
class Misi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'misi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['misi'], 'required'],
            [['misi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode Misi',
            'misi' => 'Visi Misi Provinsi',
        ];
    }
}
