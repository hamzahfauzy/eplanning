<?php

namespace emusrenbang\models;

use Yii;
use common\models\TaRpjmdProgramPrioritas;

/**
 * This is the model class for table "Ta_Hasil".
 *
 * @property int $Id
 * @property string $Tahun
 * @property int $Kd_Tahapan
 * @property int $Kd_Peraturan
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Rek_1
 * @property int $Kd_Rek_2
 * @property int $Kd_Rek_3
 * @property int $Kd_Rek_4
 * @property int $Kd_Rek_5
 * @property int $No_Rinc
 * @property int $No_ID
 * @property string $Ket_Prog
 * @property string $Ket_Kegiatan
 * @property string $Lokasi
 * @property string $Kelompok_sasaran
 * @property double $Pagu_Anggaran
 * @property double $Pagu_Anggaran_Nt1
 * @property string $Waktu_Pelaksanaan
 * @property int $Kd_Sumber
 * @property int $Kd_Ap_Pub
 * @property string $Keterangan
 * @property string $Sat_1
 * @property string $Nilai_1
 * @property string $Sat_2
 * @property string $Nilai_2
 * @property string $Sat_3
 * @property string $Nilai_3
 * @property string $Satuan123
 * @property string $Jml_Satuan
 * @property string $Nilai_Rp
 * @property string $Total
 * @property string $Asal_Biaya
 * @property string $Uraian_Asal_Biaya
 * @property string $Ref_Usulan_Rincian
 * @property string $DateCreate
 * @property int $Flat
 * @property string $Token
 *
 * @property TaPeraturan $tahun
 */
class TaHasil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Hasil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'DateCreate'], 'safe'],
            [[//'Kd_Tahapan', 'Kd_Peraturan', 
			'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'No_ID', 'Kd_Sumber', 'Kd_Ap_Pub', 'Flat'], 'integer'],
            [['Pagu_Anggaran', 'Pagu_Anggaran_Nt1', 'Nilai_1', 'Nilai_2', 'Nilai_3', 'Jml_Satuan', 'Nilai_Rp', 'Total'], 'number'],
            [['Asal_Biaya', 'Uraian_Asal_Biaya', 'Ref_Usulan_Rincian'], 'string'],
            [['Ket_Prog', 'Ket_Kegiatan', 'Lokasi', 'Kelompok_sasaran', 'Waktu_Pelaksanaan', 'Keterangan', 'Token','Judul'], 'string', 'max' => 255],
            [['Sat_1', 'Sat_2', 'Sat_3'], 'string', 'max' => 10],
            [['Satuan123'], 'string', 'max' => 50],
            [['Tahun', 'Kd_Tahapan', 'Kd_Peraturan'], 'exist', 'skipOnError' => true, 'targetClass' => TaPeraturan::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Tahapan' => 'Kd_Tahapan', 'Kd_Peraturan' => 'Kd_Peraturan']],
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
            'Kd_Tahapan' => 'Kd  Tahapan',
            'Kd_Peraturan' => 'Kd  Peraturan',
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
            'No_ID' => 'No  ID',
            'Ket_Prog' => 'Ket  Prog',
            'Ket_Kegiatan' => 'Ket  Kegiatan',
            'Lokasi' => 'Lokasi',
            'Kelompok_sasaran' => 'Kelompok Sasaran',
            'Pagu_Anggaran' => 'Pagu  Anggaran',
            'Pagu_Anggaran_Nt1' => 'Pagu  Anggaran  Nt1',
            'Waktu_Pelaksanaan' => 'Waktu  Pelaksanaan',
            'Kd_Sumber' => 'Kd  Sumber',
            'Kd_Ap_Pub' => 'Kd  Ap  Pub',
            'Keterangan' => 'Keterangan',
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
            'Asal_Biaya' => 'Asal  Biaya',
            'Uraian_Asal_Biaya' => 'Uraian  Asal  Biaya',
            'Ref_Usulan_Rincian' => 'Ref  Usulan  Rincian',
            'DateCreate' => 'Date Create',
            'Flat' => 'Flat',
            'Token' => 'Token',
			'Judul'=>'Judul',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaPeraturan::className(), ['Tahun' => 'Tahun', 'Kd_Tahapan' => 'Kd_Tahapan', 'Kd_Peraturan' => 'Kd_Peraturan']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaHasilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaHasilQuery(get_called_class());
    }
	
	public function getTaRpjmdProgramPrioritas()
    {
        return $this->hasOne(TaRpjmdProgramPrioritas::className(), ['Kd_Prog' => 'Kd_Prog']);
    }

    public function getTaKegiatans() {
        return $this->hasMany(TaHasil::className(), ['Tahun' => 'Tahun', 'Kd_Tahapan' => 'Kd_Tahapan', 'Kd_Peraturan' => 'Kd_Peraturan', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog'])->where(['Asal_Data' => 2]);
    }

    public function getTaIndikatorsKinerja()
    {
        return $this->hasOne(TaHasil::className(), ['Tahun' => 'Tahun', 'Kd_Tahapan' => 'Kd_Tahapan', 'Kd_Peraturan' => 'Kd_Peraturan', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg'])->where(['Asal_Data' => 6])->andOnCondition(['Kd_Indikator' => '3']);
    }

    public function getPagukegiatans() 
    {
        return $this->hasMany(TaHasil::className(), ['Tahun' => 'Tahun', 'Kd_Tahapan' => 'Kd_Tahapan', 'Kd_Peraturan' => 'Kd_Peraturan', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg'])->where(['Asal_Data' => 5])->sum('Total');
    } 
}
