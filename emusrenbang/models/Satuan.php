<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "satuan".
 *
 * @property integer $id
 * @property string $satuan
 */
class Satuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'satuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['satuan'], 'required'],
            [['satuan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satuan' => 'Satuan',
        ];
    }
}
