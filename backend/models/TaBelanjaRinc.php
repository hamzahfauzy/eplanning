<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Belanja_Rinc".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property integer $Kd_Keg
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property integer $Kd_Rek_5
 * @property integer $No_Rinc
 * @property string $Keterangan
 * @property integer $Kd_Sumber
 */
class TaBelanjaRinc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Belanja_Rinc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'Keterangan'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'Kd_Sumber'], 'integer'],
            [['Keterangan'], 'string', 'max' => 255],
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
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'No_Rinc' => 'No  Rinc',
            'Keterangan' => 'Keterangan',
            'Kd_Sumber' => 'Kd  Sumber',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaBelanjaRincQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaBelanjaRincQuery(get_called_class());
    }
}
