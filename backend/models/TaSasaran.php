<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Sasaran".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property string $Ur_Sasaran
 */
class TaSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Ur_Sasaran'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'integer'],
            [['Ur_Sasaran'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Ur_Sasaran' => 'Ur  Sasaran',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaSasaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaSasaranQuery(get_called_class());
    }
}
