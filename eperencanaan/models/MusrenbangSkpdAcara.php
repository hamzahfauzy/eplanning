<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefSubUnit;
use common\models\RefKecamatan;
use common\models\RefForum;

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
class MusrenbangSkpdAcara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Musrenbang_Skpd_Acara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub_Unit', 'Waktu_Unduh_Absen', 'Nama_Tempat', 'Alamat', 'Nama_Pejabat', 'Jumlah_Peserta','Nomor_Berita_Acara','Tanggal_Berita_Acara','Pimpinan_Sidang','Jadwal_Forum'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub_Unit', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta', 'Kd_User'], 'integer'],
            [['Alamat','Nomor_Berita_Acara','Tanggal_Berita_Acara','Pimpinan_Sidang','Jadwal_Forum'], 'string'],
            [['Nama_Tempat', 'Nama_Pejabat'], 'string', 'max' => 128],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub_Unit',], 'exist', 'skipOnError' => true, 'targetClass' => RefSubUnit::className(), 'targetAttribute' => ['Kd_Urusan'=>'Kd_Urusan', 'Kd_Bidang'=>'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit', 'Kd_Sub_Unit'=>'Kd_Sub_Unit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
			'Kd_Sub_Unit' => 'Kd  Sub  Unit',
            'Waktu_Unduh_Absen' => 'Waktu  Unduh  Absen',
            'Waktu_Unduh_Berita_Acara' => 'Waktu  Unduh  Berita  Acara',
            'Waktu_Mulai' => 'Waktu  Mulai',
            'Waktu_Selesai' => 'Waktu  Selesai',
            'Nama_Tempat' => 'Nama  Tempat',
            'Alamat' => 'Alamat',
            'Nama_Pejabat' => 'Nama  Pejabat',
            'Jumlah_Peserta' => 'Jumlah  Peserta',
            'Kd_User' => 'Kd  User',
	    'Nomor_Berita_Acara'=>'Nomor Berita Acara',
	    'Tanggal_Berita_Acara' => 'Tanggal Berita Acara',
	    'Pimpinan_Sidang' => 'Pimpinan Sidang',
	    'Jadwal_Forum' => 'Jadwal Forum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getsub1()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub_Unit']);
    }
 public function getKdKec()
    {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
     * @inheritdoc
     * @return MusrenbangSkpdAcaraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MusrenbangSkpdAcaraQuery(get_called_class());
    }
}
