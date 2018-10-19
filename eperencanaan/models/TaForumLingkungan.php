<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefJalan;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefStandardSatuan;
use common\models\RefProvinsi;
use common\models\RefLingkungan;
use common\models\RefStatusUsulan;
use common\models\RefBidangPembangunan;
use eperencanaan\models\TaUsulanLingkunganMedia;

/**
 * This is the model class for table "Ta_Forum_Lingkungan".
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
 * @property double $Latitute
 * @property double $Longitude
 * @property integer $Tanggal
 * @property integer $status
 * @property integer $Status_Survey
 *
 * @property RefJalan $kdProv
 * @property RefStatusUsulan $statusSurvey
 * @property RefStandardSatuan $kdSatuan
 * @property RefBidangPembangunan $kdPem
 * @property TaUsulanLingkunganMedia[] $taUsulanLingkunganMedia
 */
class TaForumLingkungan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Forum_Lingkungan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Pem', 'Nm_Permasalahan', 'Kd_Klasifikasi', 'Jenis_Usulan', 'Jumlah', 'Kd_Satuan', 'Harga_Satuan', 'Harga_Total', 'Kd_Sasaran', 'Tanggal'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Pem', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status', 'Status_Survey'], 'integer'],
            [['Nm_Permasalahan', 'Jenis_Usulan', 'Detail_Lokasi'], 'string'],
        //    [['Harga_Satuan', 'Harga_Total', 'Latitute', 'Longitude'], 'number'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan'], 'exist', 'skipOnError' => true, 'targetClass' => RefJalan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan', 'Kd_Jalan' => 'Kd_Jalan']],
            [['Status_Survey'], 'exist', 'skipOnError' => true, 'targetClass' => RefStatusUsulan::className(), 'targetAttribute' => ['Status_Survey' => 'Kd_Status']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            [['Kd_Pem'], 'exist', 'skipOnError' => true, 'targetClass' => RefBidangPembangunan::className(), 'targetAttribute' => ['Kd_Pem' => 'Kd_Pem']],
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
            'Kd_Kec' => 'Kecamatan',
            'Kd_Kel' => 'Kelurahan',
            'Kd_Urut_Kel' => 'Kelurahan',
            'Kd_Lingkungan' => 'Lingkungan',
            'Kd_Jalan' => 'Jalan',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Pem' => 'Bidang Pembangunan',
            'Nm_Permasalahan' => 'Permasalahan',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Jenis_Usulan' => 'Usulan',
            'Jumlah' => 'Jumlah',
            'Kd_Satuan' => 'Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
            'Harga_Total' => 'Harga  Total',
            'Kd_Sasaran' => 'Kd  Sasaran',
            'Detail_Lokasi' => 'Detail  Lokasi',
            'Latitute' => 'Latitute',
            'Longitude' => 'Longitude',
            'Tanggal' => 'Tanggal',
            'status' => 'Status',
            'Status_Survey' => 'Status  Survey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusSurvey()
    {
        return $this->hasOne(RefStatusUsulan::className(), ['Kd_Status' => 'Status_Survey']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUsulanLingkunganMedia()
    {
        return $this->hasMany(TaUsulanLingkunganMedia::className(), ['Kd_Ta_Forum_Lingkungan' => 'Kd_Ta_Forum_Lingkungan']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaForumLingkunganQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaForumLingkunganQuery(get_called_class());
    }
        
    public function getKdSatuan() {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Kd_Satuan']);
    }
    
    public function getKdPem()
    {
        return $this->hasOne(RefBidangPembangunan::className(), ['Kd_Pem' => 'Kd_Pem']);
    }
    
    public function getKdProv() {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    public function getKdKab() {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getKdKec() {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    public function getKdKel() {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel','Kd_Urut'=>'Kd_Urut_Kel']);
    }

    public function getKdLink() {
        return $this->hasOne(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel'=>'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    public function getKdJalan() {
        return $this->hasOne(RefJalan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel'=>'Kd_Urut_Kel','Kd_Lingkungan' => 'Kd_Lingkungan', 'Kd_Jalan' => 'Kd_Jalan']);
    }
    
    public function getStatusKelurahan(){
        return $this->hasOne(TaKelurahanVerifikasiUsulanLingkungan::className(),['Kd_Ta_Forum_Lingkungan' => 'Kd_Ta_Forum_Lingkungan']);
    }
}
