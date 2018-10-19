<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefKecamatan;

/**
 * This is the model class for table "Ta_Musrenbang_Kecamatan_Acara".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Waktu_Unduh_Absen
 * @property integer $Waktu_Unduh_Berita_Acara
 * @property integer $Waktu_Mulai
 * @property integer $Waktu_Selesai
 * @property string $Nama_Tempat
 * @property string $Alamat
 * @property string $Nama_Pejabat
 * @property integer $Jumlah_Peserta
 * @property integer $Kd_User
 *
 * @property RefKecamatan $kdProv
 */
class TaMusrenbangKecamatanAcara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kecamatan_Acara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
/*Edited By RIpin */
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Waktu_Unduh_Absen', 'Nama_Tempat', 'Alamat', 'Nama_Pejabat', 'Jumlah_Peserta', 
		'Nomor_Berita_Acara','Tanggal_Berita_Acara','Pimpinan_Sidang', 'Sambutan_1','Sambutan_2','Sambutan_3','Sambutan_4','Sambutan_5','Pemateri_1','Pemateri_2','Pemateri_3'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta', 'Kd_User'], 'integer'],
            [['Alamat'], 'string'],
            [['Nama_Tempat', 'Nama_Pejabat', 
	      'Nomor_Berita_Acara','Tanggal_Berita_Acara','Pimpinan_Sidang', 'Sambutan_1','Sambutan_2','Sambutan_3','Sambutan_4','Sambutan_5','Pemateri_1','Pemateri_2','Pemateri_3'], 'string', 'max' => 128],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'exist', 'skipOnError' => true, 'targetClass' => RefKecamatan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']],
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
            'Waktu_Unduh_Absen' => 'Waktu  Unduh  Absen',
            'Waktu_Unduh_Berita_Acara' => 'Waktu  Unduh  Berita  Acara',
            'Waktu_Mulai' => 'Waktu  Mulai',
            'Waktu_Selesai' => 'Waktu  Selesai',
            'Nama_Tempat' => 'Nama  Tempat',
            'Alamat' => 'Alamat',
            'Nama_Pejabat' => 'Nama  Pejabat',
            'Jumlah_Peserta' => 'Jumlah  Peserta',
            'Kd_User' => 'Kd  User',
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
    public function getKdKec()
    {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
     * @inheritdoc
     * @return TaMusrenbangKecamatanAcaraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaMusrenbangKecamatanAcaraQuery(get_called_class());
    }
}
