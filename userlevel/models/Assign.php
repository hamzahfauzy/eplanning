<?php

namespace userlevel\models;

use Yii;

/**
 * This is the model class for table "Ref_Bidang".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property string $Nm_Bidang
 * @property integer $Kd_Fungsi
 */
class Assign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    //public $Nm_Urusan;
    //public $Nm_Fungsi;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['item_name', 'user_id'], 'integer'],
            [['item_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
        ];
    }
}
