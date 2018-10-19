<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Program_Riwayat".
 *
 * @property int $Id
 * @property string $Tahun
 * @property int $Kd_Urusan untuk filter / kode skpd
 * @property int $Kd_Bidang untuk filter / koda skpd
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property string $Ket_Prog
 * @property string $Tolak_Ukur
 * @property double $Target_Angka
 * @property string $Target_Uraian
 * @property int $Kd_Urusan1 untuk filter per program
 * @property int $Kd_Bidang1 untuk filter per program
 * @property string $Tanggal_Riwayat
 * @property string $Keterangan_Riwayat Tambah, Edit, Hapus
 *
 * @property TaProgram $tahun
 */
class TaProgramRiwayat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Program_Riwayat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Ket_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'required'],
            [['Tahun', 'Tanggal_Riwayat'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'integer'],
            [['Target_Angka'], 'number'],
            [['Keterangan_Riwayat'], 'string'],
            [['Ket_Prog', 'Tolak_Ukur', 'Target_Uraian'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => TaProgram::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Ket_Prog' => 'Ket  Prog',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Angka' => 'Target  Angka',
            'Target_Uraian' => 'Target  Uraian',
            'Kd_Urusan1' => 'Kd  Urusan1',
            'Kd_Bidang1' => 'Kd  Bidang1',
            'Tanggal_Riwayat' => 'Tanggal  Riwayat',
            'Keterangan_Riwayat' => 'Keterangan  Riwayat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaProgram::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaProgramRiwayatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaProgramRiwayatQuery(get_called_class());
    }
}
