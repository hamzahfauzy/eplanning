<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Pembiayaan_Rinc".
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
 * @property integer $No_ID
 * @property string $Sat_1
 * @property double $Nilai_1
 * @property string $Sat_2
 * @property double $Nilai_2
 * @property string $Sat_3
 * @property double $Nilai_3
 * @property string $Satuan123
 * @property double $Jml_Satuan
 * @property double $Nilai_Rp
 * @property double $Total
 * @property string $Keterangan
 */
class TaPembiayaanRinc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pembiayaan_Rinc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_ID', 'Nilai_1', 'Nilai_2', 'Nilai_3', 'Satuan123', 'Jml_Satuan', 'Nilai_Rp', 'Total'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_ID'], 'integer'],
            [['Nilai_1', 'Nilai_2', 'Nilai_3', 'Jml_Satuan', 'Nilai_Rp', 'Total'], 'number'],
            [['Sat_1', 'Sat_2', 'Sat_3'], 'string', 'max' => 10],
            [['Satuan123'], 'string', 'max' => 50],
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
            'No_ID' => 'No  ID',
            'Sat_1' => 'Sat 1',
            'Nilai_1' => 'Nilai 1',
            'Sat_2' => 'Sat 2',
            'Nilai_2' => 'Nilai 2',
            'Sat_3' => 'Sat 3',
            'Nilai_3' => 'Nilai 3',
            'Satuan123' => 'Satuan123',
            'Jml_Satuan' => 'Jml  Satuan',
            'Nilai_Rp' => 'Nilai  Rp',
            'Total' => 'Total',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaPembiayaanRincQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPembiayaanRincQuery(get_called_class());
    }
}
