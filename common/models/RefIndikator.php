<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Indikator".
 *
 * @property integer $Kd_Indikator
 * @property string $Nm_Indikator
 */
class RefIndikator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Indikator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Indikator', 'Nm_Indikator'], 'required'],
            [['Kd_Indikator'], 'integer'],
            [['Nm_Indikator'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Indikator' => 'Kd  Indikator',
            'Nm_Indikator' => 'Nm  Indikator',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefIndikatorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefIndikatorQuery(get_called_class());
    }
}
