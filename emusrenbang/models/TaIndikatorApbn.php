<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Indikator_Apbn".
 *
 * @property int $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Indikator
 * @property int $No_ID
 * @property string $Tolak_Ukur
 * @property double $Target_Angka
 * @property string $Target_Uraian
 */
class TaIndikatorApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Indikator_Apbn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg', 'Kd_Indikator', 'No_ID'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Indikator', 'No_ID'], 'integer'],
            [['Target_Angka'], 'number'],
            [['Tolak_Ukur', 'Target_Uraian'], 'string', 'max' => 255],
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
            'Kd_Indikator' => 'Kd  Indikator',
            'No_ID' => 'No  ID',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Angka' => 'Target  Angka',
            'Target_Uraian' => 'Target  Uraian',
        ];
    }

    /**
     * @inheritdoc
     * @return TaIndikatorApbnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaIndikatorApbnQuery(get_called_class());
    }
}
