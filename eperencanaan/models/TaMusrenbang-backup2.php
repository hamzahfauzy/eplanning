<?php

namespace eperencanaan\models;

use Yii;
use common\models\TaSubUnit;
use eperencanaan\models\TaProgram;
use common\models\RefBidangPembangunan;
use common\models\RefSubUnit;

use eperencanaan\models\TaSasaran;
use common\models\RefRPJMD;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefDapil;
use common\models\RefProvinsi;
use eperencanaan\models\TaKegiatan;
use common\models\RefStandardSatuan;
use common\models\RefLingkungan;
use common\models\RefJalan;
use eperencanaan\models\query\TaMusrenbangQuery;
use common\models\RefStatusUsulan;
use eperencanaan\models\TaForumLingkungan;


/**
 * This is the model class for table "Ta_Musrenbang".
 *
 * @property int $id
 * @property string $Tahun
 * @property int $Kd_Prov
 * @property int $Kd_Kab
 * @property int $Kd_Kec
 * @property int $Kd_Kel
 * @property int $Kd_Urut_Kel
 * @property int $Kd_Lingkungan Ref_Lingkungan
 * @property int $Kd_Dapil
 * @property int $Kd_User_Dapil
 * @property int $Kd_Jalan Ref_Jalan
 * @property int $Kd_Urusan Ref_URusan -> Ta _Subunit
 * @property int $Kd_Bidang Ref_Bidang -> Ta SubUnit
 * @property int $Kd_Prog Ta_PRogram -> Ta_Kegiatan
 * @property int $Kd_Keg Ta_Kegiatan
 * @property int $Kd_Unit Ref_Unit -> Ta_SubUnit
 * @property int $Kd_Sub Ta_SubUnit
 * @property int $Kd_Pem Ref_Bidang_PEmbangunan
 * @property string $Nm_Permasalahan
 * @property int $Kd_Klasifikasi Fisik dan Non Fisik
 * @property string $Jenis_Usulan
 * @property int $Jumlah
 * @property int $Kd_Satuan Ref_Standard_satuan
 * @property double $Harga_Satuan
 * @property double $Harga_Total
 * @property int $Kd_Sasaran Ta_Sasaran
 * @property string $Detail_Lokasi
 * @property string $Latitute
 * @property string $Longitude
 * @property string $Tanggal
 * @property int $status
 * @property int $Status_Survey -
 * @property int $Kd_Prioritas_Pembangunan_Daerah Ref_RPJMD
 * @property string $Skor Total Nilai Skor
 * @property string $Rincian_Skor Serialize dari rincian skor
 * @property int $Status_Usulan gk  di pakai
 * @property string $Status_Penerimaan_Kelurahan 0. belum bahas, 1 terima, 2 terima dengan perubahan 3 tolak (usulan lingkungan di bahas tingkat kelurahan)
 * @property string $Alasan_Kelurahan alasan kelurahan menolak atau terima usulan lingkungan
 * @property string $Status_Penerimaan_Kecamatan 0. belum bahas, 1 terima, 2 terima dengan perubahan 3 tolak (usulan kelurahan di bahas tingkat kecamatan)
 * @property string $Alasan_Kecamatan alasan kecamatan menolak atau terima usulan kelurahan
 * @property string $Status_Penerimaan_Skpd 0. belum bahas, 1 terima, 2 terima dengan perubahan 3 tolak (usulan kecamtan di bahas tingkat skpd)
 * @property string $Alasan_Skpd alasan skpd menolak atau terima usulan kecamatan
 * @property string $Status_Penerimaan_Kota 0. belum bahas, 1 terima, 2 terima dengan perubahan 3 tolak (usulan kecamtan di bahas tingkat skpd)
 * @property string $Alasan_Kota alasan kota menolak atau terima usulan skpd
 * @property int $Kd_User Di isi User yang entry
 * @property string $Kd_Asal 1. ssh, 2, hspk, 3 asb
 * @property int $Kd1
 * @property int $Kd2
 * @property int $Kd3
 * @property int $Kd4
 * @property int $Kd5
 * @property int $Kd6
 * @property string $Uraian_Usulan Serialize dari rincian kegiatan ssh, hspk atau asb
 * @property string $Kd_Asal_Usulan 1. lingkungan, 2. kelurahan, 3. kecamatan, 4. skpd, 5. pokir
 * @property string $Status_Prioritas 0. non prioritas, 1 prioritas
 *
 * @property RefStandardSatuan $kdSatuan
 * @property TaMusrenbangRiwayat[] $taMusrenbangRiwayats
 */
class TaMusrenbang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang';
    }

    /**
     * @inheritdoc
     */

    public $jumlah;

    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Nm_Permasalahan', 'Jenis_Usulan', 'Jumlah', 'Kd_Satuan', 'Harga_Satuan', 'Harga_Total', 'Tanggal', 'Kd_User'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Dapil', 'Kd_User_Dapil', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'Kd_Pem', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status', 'Status_Survey', 'Kd_Prioritas_Pembangunan_Daerah', 'Status_Usulan', 'Kd_User', 'Kd1', 'Kd2', 'Kd3', 'Kd4', 'Kd5', 'Kd6'], 'integer'],
            [['Nm_Permasalahan', 'Jenis_Usulan', 'Detail_Lokasi', 'Rincian_Skor', 'Status_Penerimaan_Kelurahan', 'Alasan_Kelurahan', 'Status_Penerimaan_Kecamatan', 'Alasan_Kecamatan', 'Status_Penerimaan_Skpd', 'Alasan_Skpd', 'Status_Penerimaan_Kota', 'Alasan_Kota', 'Kd_Asal', 'Uraian_Usulan', 'Kd_Asal_Usulan', 'Status_Prioritas'], 'string'],
            [['Harga_Satuan', 'Harga_Total', 'Skor'], 'number'],
            [['Latitute', 'Longitude'], 'string', 'max' => 20],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        'id' => 'ID',
            'Tahun' => 'Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kecamatan',
            'Kd_Kel' => 'Kelurahan',
            'Kd_Urut_Kel' => 'Kelurahan',
            'Kd_Lingkungan' => 'Lingkungan',
            'Kd_Dapil' => 'Derah Pemilihan',
            'Kd_User_Dapil' => 'Anggota  Dewan',
            'Kd_Jalan' => 'Kd  Jalan',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Unit' => 'Unit',
            'Kd_Sub' => 'Sub Unit/SKPD',
            'Kd_Pem' => 'Bidang Pembangunan',
            'Nm_Permasalahan' => 'Permasalahan',
            'Kd_Klasifikasi' => 'Klasifikasi',
            'Jenis_Usulan' => 'Jenis  Usulan',
            'Jumlah' => 'Jumlah',
            'Kd_Satuan' => 'Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
            'Harga_Total' => 'Harga  Total',
            'Kd_Sasaran' => 'Sasaran',
            'Detail_Lokasi' => 'Detail  Lokasi',
            'Latitute' => 'Latitude',
            'Longitude' => 'Longitude',
            'Tanggal' => 'Tanggal',
            'status' => 'Status',
            'Status_Survey' => 'Status  Survey',
            'Kd_Prioritas_Pembangunan_Daerah' => 'Prioritas  Pembangunan  Daerah',
            'Skor' => 'Skor',
            'Rincian_Skor' => 'Rincian  Skor',
            'Status_Usulan' => 'Status  Usulan',
            'Status_Penerimaan_Kelurahan' => 'Status  Penerimaan  Kelurahan',
            'Alasan_Kelurahan' => 'Alasan  Kelurahan',
            'Status_Penerimaan_Kecamatan' => 'Status  Penerimaan  Kecamatan',
            'Alasan_Kecamatan' => 'Alasan  Kecamatan',
            'Status_Penerimaan_Skpd' => 'Status  Penerimaan  Skpd',
            'Alasan_Skpd' => 'Alasan  Skpd',
            'Status_Penerimaan_Kota' => 'Status  Penerimaan  Kota',
            'Alasan_Kota' => 'Alasan  Kota',
            'Kd_User' => 'Kd  User',
            'Kd_Asal' => 'Kd  Asal',
            'Kd1' => 'Kd1',
            'Kd2' => 'Kd2',
            'Kd3' => 'Kd3',
            'Kd4' => 'Kd4',
            'Kd5' => 'Kd5',
            'Kd6' => 'Kd6',
            'Uraian_Usulan' => 'Uraian  Usulan',
            'Kd_Asal_Usulan' => 'Kd  Asal  Usulan',
            'Status_Prioritas' => 'Status Prioritas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSatuan()
    {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Kd_Satuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangRiwayats()
    {
        return $this->hasMany(TaMusrenbangRiwayat::className(), ['Ta_Musrenbang_Id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaMusrenbangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaMusrenbangQuery(get_called_class());
    }

      public function getSubUnit() {
        return $this->hasOne(TaSubUnit::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getRefSubUnit() {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram() {
        return $this->hasOne(TaProgram::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangPembangunan() {
        return $this->hasOne(RefBidangPembangunan::className(), ['Kd_Pem' => 'Kd_Pem']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSasaran() {
        return $this->hasOne(TaSasaran::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRpjmd() {
        return $this->hasOne(RefRPJMD::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Kota' => 'Kd_Prioritas_Pembangunan_Daerah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten() {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan() {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan() {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLingkungan() {
        return $this->hasOne(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi() {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getkegiatan() {
        return $this->hasOne(TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan() {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Kd_Satuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMusrenbangRiwayats() {
        return $this->hasMany(TaMusrenbangRiwayat::className(), ['Ta_Musrenbang_Id' => 'id']);
    }

    public function getKdJalan()
    {
        return $this->hasOne(RefJalan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan', 'Kd_Jalan' => 'Kd_Jalan']);
    }

    public function getUsulan()
    {
        return $this->hasOne(RefStatusUsulan::className(), ['Kd_Status' => 'Status_Usulan']);
    }

        public function getTaForumLingkunganMedia()
    {
        return $this->hasOne(TaForumLingkunganMedia::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    public function getDapil() {
        return $this->hasOne(RefDapil::className(), ['Kd_Dapil'=>'Kd_Dapil']);
    }

    public function getTaForumLingkungan() {
        return $this->hasOne(TaForumLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }
}


