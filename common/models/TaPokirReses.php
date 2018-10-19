<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "satuan".
 *
 * @property integer $id
 * @property string $satuan
 */
class TaPokirReses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pokir_Reses';
    }

     public function rules()
    {
        return [
            [['ID', 'Masa_Reses',], 'required'],
            [['ID', 'Masa_Reses',], 'integer']
        ];
    }

}
