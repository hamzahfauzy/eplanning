<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "sumber".
 *
 * @property integer $id
 * @property string $sumber
 */
class Sumber extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sumber';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sumber'], 'required'],
            [['sumber'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sumber' => 'Sumber',
        ];
    }
}
