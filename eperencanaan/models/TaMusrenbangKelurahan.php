<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefKelurahan;
use common\models\RefRPJMD;
use common\models\RefStandardSatuan;
use common\models\RefBidangPembangunan;
use common\models\RefJalan;
use common\models\RefSubUnit;
use common\models\RefLingkungan;

/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut_Kel
 * @property integer $Kd_Lingkungan
 * @property integer $Kd_Jalan
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
 * @property integer $Kd_Ta_Musrenbang_Kelurahan
 * @property integer $Kd_Prioritas_Pembangunan_Daerah
 * @property integer $Nilai
 * @property integer $Status_Usulan
 * @property string $Status_Pembahasan
 * @property integer $Kd_User
 *
 * @property RefKelurahan $kdProv
 * @property RefStandardSatuan $kdSatuan
 * @property RefRPJMD $tahun
 * @property TaMusrenbangKelurahanAcara $tahun0
 * @property TaRelasiMusrenbangKelurahan[] $taRelasiMusrenbangKelurahans
 * @property TaKelurahanVerifikasiUsulanLingkungan[] $kdTaMusrenbangKelurahanVerifikasis
 * @property TaUsulanKelurahanMedia[] $taUsulanKelurahanMedia
 */
class TaMusrenbangKelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Pem', 'Nm_Permasalahan', 'Kd_Klasifikasi', 'Jenis_Usulan', 'Jumlah', 'Kd_Satuan', 'Harga_Satuan', 'Harga_Total', 'Kd_Sasaran', 'Tanggal', 'Kd_Prioritas_Pembangunan_Daerah', 'Kd_User'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 
			//'Kd_Urusan', 'Kd_Bidang', 
			'Kd_Prog', 'Kd_Keg', 'Kd_Pem', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status', 'Status_Survey', 'Kd_Prioritas_Pembangunan_Daerah', 'Nilai', 'Status_Usulan', 'Kd_User'], 'integer'],
            [['Nm_Permasalahan', 'Jenis_Usulan', 'Detail_Lokasi', 'Status_Pembahasan'], 'string'],
            [['Harga_Satuan', 'Harga_Total'], 'number'],
            [['Latitute', 'Longitude'], 'string', 'max' => 20],
            // [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Daerah'], 'exist', 'skipOnError' => true, 'targetClass' => RefRPJMD::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Daerah' => 'Kd_Prioritas_Pembangunan_Kota']],
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel'], 'exist', 'skipOnError' => true, 'targetClass' => TaMusrenbangKelurahanAcara::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Kel' => 'Kd  Kel',
            'Kd_Urut_Kel' => 'Kd  Urut  Kel',
            'Kd_Lingkungan' => 'Kd  Lingkungan',
            'Kd_Jalan' => 'Kd  Jalan',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Pem' => 'Kd  Pem',
            'Nm_Permasalahan' => 'Nm  Permasalahan',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Jenis_Usulan' => 'Jenis  Usulan',
            'Jumlah' => 'Volume',
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
            'Kd_Ta_Musrenbang_Kelurahan' => 'Kd  Ta  Musrenbang  Kelurahan',
            'Kd_Prioritas_Pembangunan_Daerah' => 'Kd  Prioritas  Pembangunan  Daerah',
            'Nilai' => 'Nilai',
            'Status_Usulan' => 'Status  Usulan',
            'Status_Pembahasan' => 'Status  Pembahasan',
            'Kd_User' => 'Kd  User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel']);
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
    public function getTahun()
    {
        return $this->hasOne(RefRPJMD::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Kota' => 'Kd_Prioritas_Pembangunan_Daerah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun0()
    {
        return $this->hasOne(TaMusrenbangKelurahanAcara::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRelasiMusrenbangKelurahans()
    {
        return $this->hasMany(TaRelasiMusrenbangKelurahan::className(), ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTaMusrenbangKelurahanVerifikasis()
    {
        return $this->hasMany(TaKelurahanVerifikasiUsulanLingkungan::className(), ['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => 'Kd_Ta_Musrenbang_Kelurahan_Verifikasi'])->viaTable('Ta_Relasi_Musrenbang_Kelurahan', ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUsulanKelurahanMedia()
    {
        return $this->hasMany(TaUsulanKelurahanMedia::className(), ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaMusrenbangKelurahanQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new \eperencanaan\models\query\TaMusrenbangKelurahanQuery(get_called_class());
    }

    public function getKdPem()
    {
        return $this->hasOne(RefBidangPembangunan::className(), ['Kd_Pem' => 'Kd_Pem']);
    }
    public function getKdJalan()
    {
        return $this->hasOne(RefJalan::className(), [
			'Kd_Prov'=>'Kd_Prov',
			'Kd_Kab'=>'Kd_Kab',
			'Kd_Kec'=>'Kd_Kec',
			'Kd_Kel' => 'Kd_Kel',
			'Kd_Urut_Kel' => 'Kd_Urut_Kel',
			'Kd_Lingkungan' => 'Kd_Lingkungan',
			'Kd_Jalan' => 'Kd_Jalan']);
    }
	
	public function getKdLingkungan()
    {
        return $this->hasOne(RefLingkungan::className(), [
			'Kd_Prov'=>'Kd_Prov',
			'Kd_Kab'=>'Kd_Kab',
			'Kd_Kec'=>'Kd_Kec',
			'Kd_Kel' => 'Kd_Kel',
			'Kd_Urut_Kel' => 'Kd_Urut_Kel',
			'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }
	
	public function getSubUnit()
    {
        return $this->hasOne(RefSubUnit::className(), [
			'Kd_Urusan'=>'Kd_Urusan',
			'Kd_Bidang' => 'Kd_Bidang'
			]);
    }


}
