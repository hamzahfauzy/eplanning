<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Komponen_Analisa".
 *
 * @property integer $Kd_Komponen
 * @property string $Nm_Komponen
 */
class RefKomponenAnalisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Komponen_Analisa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Komponen'], 'required'],
            [['Kd_Komponen'], 'integer'],
            [['Nm_Komponen'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Komponen' => 'Kd  Komponen',
            'Nm_Komponen' => 'Nm  Komponen',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKomponenAnalisaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKomponenAnalisaQuery(get_called_class());
    }
}
