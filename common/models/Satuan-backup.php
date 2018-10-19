<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "satuan".
 *
 * @property int $id
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

    /**
     * @inheritdoc
     * @return \common\models\query\SatuanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SatuanQuery(get_called_class());
    }
}
