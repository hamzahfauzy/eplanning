<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nawacita".
 *
 * @property integer $id
 * @property string $nawacita
 * @property integer $status
 */
class Nawacita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nawacita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nawacita'], 'required'],
            [['status'], 'integer'],
            [['nawacita'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode Nawacita',
            'nawacita' => 'Nawacita',
            'status' => 'Status',
        ];
    }
}
