<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kamus_Program".
 *
 * @property integer $Kd_Program
 * @property string $Nm_Program
 * @property integer $Status
 */
class RefKamusProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kamus_Program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Program', 'Nm_Program'], 'required'],
            [['Kd_Program', 'Status'], 'integer'],
            [['Nm_Program'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Program' => 'Kd  Program',
            'Nm_Program' => 'Nama  Program',
            'Status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKamusProgramQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKamusProgramQuery(get_called_class());
    }
}
