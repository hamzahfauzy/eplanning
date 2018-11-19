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

/**
 * This is the model class for table "Ta_Forum_Lingkungan_Acara".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut_Kel
 * @property integer $Kd_Lingkungan
 * @property integer $Waktu_Unduh_Absen
 * @property integer $Waktu_Unduh_Berita_Acara
 * @property integer $Waktu_Mulai
 * @property integer $Waktu_Selesai
 * @property string $Nama_Tempat
 * @property string $Alamat
 * @property string $Nama_Pejabat
 * @property integer $Jumlah_Peserta
 *
 * @property RefLingkungan $kdProv
 */
class TaForumLingkunganAcara extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Ta_Forum_Lingkungan_Acara';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Waktu_Unduh_Absen', 'Nama_Tempat', 'Alamat', 'Nama_Pejabat', 'Jumlah_Peserta'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta'], 'integer'],
            [['Alamat'], 'string'],
            [['Nama_Tempat', 'Nama_Pejabat'], 'string', 'max' => 128],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan'], 'exist', 'skipOnError' => true, 'targetClass' => RefLingkungan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Tahun' => 'Tahun Data',
            'Kd_Prov' => 'Provinsi',
            'Kd_Kab' => 'Kabupaten',
            'Kd_Kec' => 'Kecamatan',
            'Kd_Kel' => 'Kelurahan',
            'Kd_Urut_Kel' => 'Urut Kelurahan',
            'Kd_Lingkungan' => 'Lingkungan',
            'Waktu_Unduh_Absen' => 'Waktu  Unduh  Absen',
            'Waktu_Unduh_Berita_Acara' => 'Waktu  Unduh  Berita  Acara',
            'Waktu_Mulai' => 'Waktu  Mulai',
            'Waktu_Selesai' => 'Waktu  Selesai',
            'Nama_Tempat' => 'Nama  Tempat',
            'Alamat' => 'Alamat Kegiatan',
            'Nama_Pejabat' => 'Nama  Pejabat',
            'Jumlah_Peserta' => 'Jumlah  Peserta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaForumLingkungans()
    {
        return $this->hasMany(TaForumLingkungan::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }
    
    public function getProfile(){
        $ZUL_Kd = \userlevel\models\TaUserKelompok::findOne(['Kd_Prov' => $this->Kd_Prov, 'Kd_Kab' => $this->Kd_Kab, 'Kd_Kec' => $this->Kd_Kec, 'Kd_Kel' => $this->Kd_Kel, 'Kd_Urut_Kel' => $this->Kd_Urut_Kel, 'Kd_Lingkungan' => $this->Kd_Lingkungan]);
        $ZUL_Kd_User=$ZUL_Kd->Kd_User;
        //return $ZUL_Kd_User;
        return \userlevel\models\TaProfile::findOne(['Kd_User' => $ZUL_Kd_User]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv() {
        return $this->hasOne(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaForumLingkunganAcaraQuery the active query used by this AR class.
     */
    public static function find() {
        return new \eperencanaan\models\query\TaForumLingkunganAcaraQuery(get_called_class());
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
