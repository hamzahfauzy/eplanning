<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefKelurahan;
use common\models\RefKabupaten;
use common\models\RefProvinsi;
use common\models\RefKecamatan;
use common\models\RefLingkungan;

/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan_Acara".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut_Kel
 * @property integer $Waktu_Unduh_Absen
 * @property integer $Waktu_Unduh_Berita_Acara
 * @property integer $Waktu_Mulai
 * @property integer $Waktu_Selesai
 * @property string $Nama_Tempat
 * @property string $Alamat
 * @property string $Nama_Pejabat
 * @property integer $Jumlah_Peserta
 * @property string $Status_Pembahasan_Usulan
 *
 * @property TaMusrenbangKelurahan[] $taMusrenbangKelurahans
 * @property RefKelurahan $kdProv
 */
class TaMusrenbangKelurahanAcara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan_Acara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
/* Edited By Ripin */
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Waktu_Unduh_Absen', 'Nama_Tempat', 'Alamat', 'Nama_Pejabat', 'Jumlah_Peserta',
		'Nomor_Berita_Acara','Tanggal_Berita_Acara','Pimpinan_Sidang', 'Sambutan_1','Sambutan_2','Sambutan_3','Sambutan_4','Sambutan_5','Pemateri_1','Pemateri_2','Pemateri_3'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta'], 'integer'],
            [['Alamat', 'Status_Pembahasan_Usulan'], 'string'],
            [['Nama_Tempat', 'Nama_Pejabat',
		'Nomor_Berita_Acara','Tanggal_Berita_Acara','Pimpinan_Sidang', 'Sambutan_1','Sambutan_2','Sambutan_3','Sambutan_4','Sambutan_5','Pemateri_1','Pemateri_2','Pemateri_3'], 'string', 'max' => 128],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']],
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
            'Waktu_Unduh_Absen' => 'Waktu  Unduh  Absen',
            'Waktu_Unduh_Berita_Acara' => 'Waktu  Unduh  Berita  Acara',
            'Waktu_Mulai' => 'Waktu  Mulai',
            'Waktu_Selesai' => 'Waktu  Selesai',
            'Nama_Tempat' => 'Nama  Tempat',
            'Alamat' => 'Alamat',
            'Nama_Pejabat' => 'Nama  Pejabat',
            'Jumlah_Peserta' => 'Jumlah  Peserta',
            'Status_Pembahasan_Usulan' => 'Status  Pembahasan  Usulan',

/* Add By Ripin*/
	    'Nomor_Berita_Acara' => 'Nomor Berita Acara',
	    'Tanggal_Berita_Acara' => 'Tanggal Berita Acara',
	    'Pimpinan_Sidang' => 'Pimpinan Sidang',
	    'Sambutan_1' => 'Sambutan 1',
    	    'Sambutan_2' =>'Sambutan 2',
	    'Sambutan_3' => 'Sambutan 3',
	    'Sambutan_4' => 'Sambutan 4',
	    'Sambutan_5' => 'Sambutan 5',
	    'Pemateri_1' => 'Pemateri 1',
	    'Pemateri_2' => 'Pemateri 2',
	    'Pemateri_3' => 'Pemateri 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKelurahans()
    {
        return $this->hasMany(TaMusrenbangKelurahan::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaMusrenbangKelurahanAcaraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaMusrenbangKelurahanAcaraQuery(get_called_class());
    }
    
    public function getKdKab() {
        return $this->hasOne(RefKabupaten::className(), [/* 'Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub',
                      'Kd_Benua_Sub_Negara' => 'Kd_Benua_Sub_Negara', */'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getKdKec() {
        return $this->hasOne(RefKecamatan::className(), [/* 'Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub',
                      'Kd_Benua_Sub_Negara' => 'Kd_Benua_Sub_Negara', */'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    public function getKdKel() {
        return $this->hasOne(RefKelurahan::className(), [/* 'Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub',
                      'Kd_Benua_Sub_Negara' => 'Kd_Benua_Sub_Negara', */'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel']);
    }

    public function getKdLink() {
        return $this->hasOne(RefLingkungan::className(), [/* 'Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub',
                      'Kd_Benua_Sub_Negara' => 'Kd_Benua_Sub_Negara', */ 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    public function getKdJalan() {
        return $this->hasOne(RefJalan::className(), [/* 'Kd_Benua' => 'Kd_Benua', 'Kd_Benua_Sub' => 'Kd_Benua_Sub',
                      'Kd_Benua_Sub_Negara' => 'Kd_Benua_Sub_Negara', */ 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan', 'Kd_Jalan' => 'Kd_Jalan']);
    }
}
