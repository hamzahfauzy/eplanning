<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Prioritas".
 *
 * @property integer $Tahun
 * @property integer $Kd_Prioritas
 * @property string $Nm_Prioritas
 * @property string $Tema
 */
class TaPrioritas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Prioritas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prioritas'], 'required'],
            [['Tahun', 'Kd_Prioritas'], 'integer'],
            [['Nm_Prioritas'], 'string', 'max' => 100],
            [['Tema'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prioritas' => 'Kd  Prioritas',
            'Nm_Prioritas' => 'Nm  Prioritas',
            'Tema' => 'Tema',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaPrioritasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPrioritasQuery(get_called_class());
    }
}
