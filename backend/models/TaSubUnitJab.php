<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Sub_Unit_Jab".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Jab
 * @property integer $No_Urut
 * @property string $Nama
 * @property string $Nip
 * @property string $Jabatan
 */
class TaSubUnitJab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Sub_Unit_Jab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Jab', 'No_Urut'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Jab', 'No_Urut'], 'integer'],
            [['Nama'], 'string', 'max' => 50],
            [['Nip'], 'string', 'max' => 21],
            [['Jabatan'], 'string', 'max' => 75],
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
            'Kd_Jab' => 'Kd  Jab',
            'No_Urut' => 'No  Urut',
            'Nama' => 'Nama',
            'Nip' => 'Nip',
            'Jabatan' => 'Jabatan',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaSubUnitJabQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaSubUnitJabQuery(get_called_class());
    }
}
