<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Tim_Anggaran".
 *
 * @property integer $Tahun
 * @property integer $Kd_Tim
 * @property integer $No_Urut
 * @property string $Nama
 * @property string $NIP
 * @property string $Jabatan
 */
class TaTimAnggaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Tim_Anggaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Tim', 'No_Urut', 'Nama', 'NIP'], 'required'],
            [['Tahun', 'Kd_Tim', 'No_Urut'], 'integer'],
            [['Nama'], 'string', 'max' => 50],
            [['NIP'], 'string', 'max' => 21],
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
            'Kd_Tim' => 'Kd  Tim',
            'No_Urut' => 'No  Urut',
            'Nama' => 'Nama',
            'NIP' => 'Nip',
            'Jabatan' => 'Jabatan',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaTimAnggaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaTimAnggaranQuery(get_called_class());
    }
}
