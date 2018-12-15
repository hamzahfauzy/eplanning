<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "Ta_Kegiatan_Riwayat".
 *
 * @property int $Id
 * @property string $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $ID_Prog
 * @property string $Ket_Kegiatan
 * @property string $Lokasi
 * @property string $Kelompok_Sasaran
 * @property string $Status_Kegiatan 1. baru, 2 lanjutan
 * @property double $Pagu_Anggaran
 * @property string $Waktu_Pelaksanaan
 * @property int $Kd_Sumber
 * @property int $Status
 * @property string $Keterangan
 * @property double $Pagu_Anggaran_Nt1
 * @property int $Verifikasi_Bappeda
 * @property int $Tanggal_Verifikasi_Bappeda
 * @property string $Keterangan_Verifikasi_Bappeda
 * @property string $Tanggal_Riwayat
 * @property string $Keterangan_Riwayat Tambah, Edit, Hapus
 *
 * @property TaKegiatan $tahun
 */
class TaKegiatanRiwayat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kegiatan_Riwayat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'Status_Kegiatan', 'Status', 'Keterangan'], 'required'],
            [['Tahun', 'Tanggal_Riwayat'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Kd_Sumber', 'Status', 'Verifikasi_Bappeda', 'Tanggal_Verifikasi_Bappeda'], 'integer'],
            [['Pagu_Anggaran', 'Pagu_Anggaran_Nt1'], 'number'],
            [['Keterangan', 'Keterangan_Verifikasi_Bappeda'], 'string'],
            [['Ket_Kegiatan', 'Kelompok_Sasaran', 'Keterangan_Riwayat'], 'string', 'max' => 255],
            [['Lokasi'], 'string', 'max' => 800],
            [['Status_Kegiatan'], 'string', 'max' => 1],
            [['Waktu_Pelaksanaan'], 'string', 'max' => 100],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg'], 'exist', 'skipOnError' => true, 'targetClass' => TaKegiatan::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']],
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
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'ID_Prog' => 'Id  Prog',
            'Ket_Kegiatan' => 'Ket  Kegiatan',
            'Lokasi' => 'Lokasi',
            'Kelompok_Sasaran' => 'Kelompok  Sasaran',
            'Status_Kegiatan' => 'Status  Kegiatan',
            'Pagu_Anggaran' => 'Pagu  Anggaran',
            'Waktu_Pelaksanaan' => 'Waktu  Pelaksanaan',
            'Kd_Sumber' => 'Kd  Sumber',
            'Status' => 'Status',
            'Keterangan' => 'Keterangan',
            'Pagu_Anggaran_Nt1' => 'Pagu  Anggaran  Nt1',
            'Verifikasi_Bappeda' => 'Verifikasi  Bappeda',
            'Tanggal_Verifikasi_Bappeda' => 'Tanggal  Verifikasi  Bappeda',
            'Keterangan_Verifikasi_Bappeda' => 'Keterangan  Verifikasi  Bappeda',
            'Tanggal_Riwayat' => 'Tanggal  Riwayat',
            'Keterangan_Riwayat' => 'Keterangan  Riwayat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaKegiatanRiwayatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaKegiatanRiwayatQuery(get_called_class());
    }
}
