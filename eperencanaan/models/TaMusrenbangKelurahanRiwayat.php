<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan_Riwayat".
 *
 * @property string $Tahun
 * @property integer $Kd_Ta_Forum_Lingkungan
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut_Kel
 * @property integer $Kd_Lingkungan
 * @property integer $Kd_Jalan
 * @property integer $Kd_Ta_Musrenbang_Kelurahan
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 * @property integer $Kd_Pem
 * @property string $Nm_Permasalahan
 * @property integer $Kd_Klasifikasi
 * @property string $Jenis_Usulan
 * @property integer $Jumlah
 * @property integer $Kd_Satuan
 * @property double $Harga_Satuan
 * @property double $Harga_Total
 * @property integer $Kd_Sasaran
 * @property string $Detail_Lokasi
 * @property string $Latitute
 * @property string $Longitude
 * @property integer $Tanggal
 * @property integer $status
 * @property integer $Status_Survey
 * @property integer $Kd_Prioritas_Pembangunan_Daerah
 * @property integer $Nilai
 * @property integer $Status_Usulan
 * @property string $Status_Pembahasan
 * @property string $Keterangan
 * @property integer $Kd_User
 */
class TaMusrenbangKelurahanRiwayat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan_Riwayat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Ta_Musrenbang_Kelurahan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Pem', 'Nm_Permasalahan', 'Kd_Klasifikasi', 'Jenis_Usulan', 'Jumlah', 'Kd_Satuan', 'Harga_Satuan', 'Harga_Total', 'Kd_Sasaran', 'Tanggal', 'Kd_Prioritas_Pembangunan_Daerah'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Ta_Musrenbang_Kelurahan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Pem', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status', 'Status_Survey', 'Kd_Prioritas_Pembangunan_Daerah', 'Nilai', 'Status_Usulan', 'Kd_User'], 'integer'],
            [['Nm_Permasalahan', 'Jenis_Usulan', 'Detail_Lokasi', 'Status_Pembahasan', 'Keterangan'], 'string'],
            [['Harga_Satuan', 'Harga_Total'], 'number'],
            [['Latitute', 'Longitude'], 'string', 'max' => 20],
            [['Kd_Ta_Musrenbang_Kelurahan'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Ta_Forum_Lingkungan' => 'Kd  Ta  Forum  Lingkungan',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Kel' => 'Kd  Kel',
            'Kd_Urut_Kel' => 'Kd  Urut  Kel',
            'Kd_Lingkungan' => 'Kd  Lingkungan',
            'Kd_Jalan' => 'Kd  Jalan',
            'Kd_Ta_Musrenbang_Kelurahan' => 'Kd  Ta  Musrenbang  Kelurahan',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Pem' => 'Kd  Pem',
            'Nm_Permasalahan' => 'Nm  Permasalahan',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Jenis_Usulan' => 'Jenis  Usulan',
            'Jumlah' => 'Jumlah',
            'Kd_Satuan' => 'Kd  Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
            'Harga_Total' => 'Harga  Total',
            'Kd_Sasaran' => 'Kd  Sasaran',
            'Detail_Lokasi' => 'Detail  Lokasi',
            'Latitute' => 'Latitute',
            'Longitude' => 'Longitude',
            'Tanggal' => 'Tanggal',
            'status' => 'Status',
            'Status_Survey' => 'Status  Survey',
            'Kd_Prioritas_Pembangunan_Daerah' => 'Kd  Prioritas  Pembangunan  Daerah',
            'Nilai' => 'Nilai',
            'Status_Usulan' => 'Status  Usulan',
            'Status_Pembahasan' => 'Status  Pembahasan',
            'Keterangan' => 'Keterangan',
            'Kd_User' => 'Kd  User',
        ];
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaMusrenbangKelurahanRiwayatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaMusrenbangKelurahanRiwayatQuery(get_called_class());
    }
}
