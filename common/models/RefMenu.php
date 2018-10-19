<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Menu".
 *
 * @property integer $Tahun
 * @property string $User_ID
 * @property string $ID_Menu
 * @property string $Otoritas
 */
class RefMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'User_ID', 'ID_Menu'], 'required'],
            [['Tahun'], 'integer'],
            [['User_ID'], 'string', 'max' => 20],
            [['ID_Menu'], 'string', 'max' => 4],
            [['Otoritas'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'User_ID' => 'User  ID',
            'ID_Menu' => 'Id  Menu',
            'Otoritas' => 'Otoritas',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefMenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefMenuQuery(get_called_class());
    }
}
