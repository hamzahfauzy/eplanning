<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Fungsi".
 *
 * @property integer $Kd_Fungsi
 * @property string $Nm_Fungsi
 */
class RefFungsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Fungsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Fungsi', 'Nm_Fungsi'], 'required'],
            [['Kd_Fungsi'], 'integer'],
            [['Nm_Fungsi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Fungsi' => 'Kode  Fungsi',
            'Nm_Fungsi' => 'Fungsi',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefFungsiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefFungsiQuery(get_called_class());
    }
}
