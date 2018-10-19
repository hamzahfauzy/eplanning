<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jabatan".
 *
 * @property integer $Kd_Jab
 * @property string $Nm_Jab
 */
class RefJabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jab'], 'required'],
            [['Kd_Jab'], 'integer'],
            [['Nm_Jab'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Jab' => 'Kd  Jab',
            'Nm_Jab' => 'Nm  Jab',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJabatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJabatanQuery(get_called_class());
    }
}
