<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kode_Tim".
 *
 * @property integer $Kd_Tim
 * @property string $Nm_Tim
 */
class RefKodeTim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kode_Tim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Tim'], 'required'],
            [['Kd_Tim'], 'integer'],
            [['Nm_Tim'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Tim' => 'Kd  Tim',
            'Nm_Tim' => 'Nm  Tim',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKodeTimQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKodeTimQuery(get_called_class());
    }
}
