<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Peraturan".
 *
 * @property integer $Tahun
 * @property integer $Kd_Peraturan
 * @property integer $No_ID
 * @property string $No_Peraturan
 * @property string $Tgl_Peraturan
 * @property string $Uraian
 */
class TaPeraturan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Peraturan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Peraturan', 'No_ID', 'Uraian'], 'required'],
            [['Tahun', 'Kd_Peraturan', 'No_ID'], 'integer'],
            [['Tgl_Peraturan'], 'safe'],
            [['No_Peraturan'], 'string', 'max' => 50],
            [['Uraian'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Peraturan' => 'Kd  Peraturan',
            'No_ID' => 'No  ID',
            'No_Peraturan' => 'No  Peraturan',
            'Tgl_Peraturan' => 'Tgl  Peraturan',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaPeraturanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPeraturanQuery(get_called_class());
    }
}
