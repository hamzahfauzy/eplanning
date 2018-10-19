<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefJalan;
use common\models\RefKegiatan;
use common\models\RefKelurahan;
use common\models\RefKlasifikasiUsulan;
use common\models\RefLingkungan;
use common\models\RefSasaran;
use common\models\RefStandardSatuan;
use common\models\RefStatusUsulan;

/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan".
 *
 * @property string $Tahun
 * @property integer $Kd_Ta_Muserenbang_Kelurahan
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
 * @property string $Nm_Permasalahan
 * @property integer $Kd_Klasifikasi
 * @property string $Jenis_Usulan
 * @property integer $Jumlah
 * @property integer $Kd_Satuan
 * @property double $Harga_Satuan
 * @property double $Harga_Total
 * @property integer $Kd_Sasaran
 * @property integer $Tanggal
 * @property integer $Kd_Status
 *
 * @property RefJalan $kdProv
 * @property RefKegiatan $kdUrusan
 * @property RefKelurahan $kdProv0
 * @property RefKlasifikasiUsulan $kdKlasifikasi
 * @property RefLingkungan $kdProv1
 * @property RefSasaran $kdSasaran
 * @property RefStandardSatuan $kdSatuan
 * @property RefStatusUsulan $kdStatus
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
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Nm_Permasalahan', 'Kd_Klasifikasi', 'Jenis_Usulan', 'Jumlah', 'Kd_Satuan', 'Harga_Satuan', 'Harga_Total', 'Kd_Sasaran', 'Tanggal', 'Kd_Status'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'Kd_Status'], 'integer'],
            [['Nm_Permasalahan', 'Jenis_Usulan'], 'string'],
            [['Harga_Satuan', 'Harga_Total'], 'number'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan'], 'exist', 'skipOnError' => true, 'targetClass' => RefJalan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan', 'Kd_Jalan' => 'Kd_Jalan']],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg'], 'exist', 'skipOnError' => true, 'targetClass' => RefKegiatan::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']],
            [['Kd_Klasifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => RefKlasifikasiUsulan::className(), 'targetAttribute' => ['Kd_Klasifikasi' => 'Kd_Klasifikasi']],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan'], 'exist', 'skipOnError' => true, 'targetClass' => RefLingkungan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']],
            [['Kd_Sasaran'], 'exist', 'skipOnError' => true, 'targetClass' => RefSasaran::className(), 'targetAttribute' => ['Kd_Sasaran' => 'Kd_Sasaran']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            [['Kd_Status'], 'exist', 'skipOnError' => true, 'targetClass' => RefStatusUsulan::className(), 'targetAttribute' => ['Kd_Status' => 'Kd_Status']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Ta_Muserenbang_Kelurahan' => 'Kd  Ta  Muserenbang  Kelurahan',
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
            'Nm_Permasalahan' => 'Nm  Permasalahan',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Jenis_Usulan' => 'Jenis  Usulan',
            'Jumlah' => 'Jumlah',
            'Kd_Satuan' => 'Kd  Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
            'Harga_Total' => 'Harga  Total',
            'Kd_Sasaran' => 'Kd  Sasaran',
            'Tanggal' => 'Tanggal',
            'Kd_Status' => 'Kd  Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefJalan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan', 'Kd_Jalan' => 'Kd_Jalan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv0()
    {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdKlasifikasi()
    {
        return $this->hasOne(RefKlasifikasiUsulan::className(), ['Kd_Klasifikasi' => 'Kd_Klasifikasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv1()
    {
        return $this->hasOne(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSasaran()
    {
        return $this->hasOne(RefSasaran::className(), ['Kd_Sasaran' => 'Kd_Sasaran']);
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
    public function getKdStatus()
    {
        return $this->hasOne(RefStatusUsulan::className(), ['Kd_Status' => 'Kd_Status']);
    }
}
