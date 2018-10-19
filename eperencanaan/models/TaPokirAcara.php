<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Pokir_Acara".
 *
 * @property string $Tahun
 * @property int $Kd_User
 * @property int $Waktu_Unduh_Absen
 * @property int $Waktu_Unduh_Berita_Acara
 * @property int $Waktu_Mulai
 * @property int $Waktu_Selesai
 * @property string $Masa_Reses
 * @property int $Tanggal_Reses
 * @property string $Nama_Tempat
 * @property string $Alamat
 * @property int $Jumlah_Peserta
 */
class TaPokirAcara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pokir_Acara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_User', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Masa_Reses', 'Tanggal_Reses', 'Nama_Tempat', 'Alamat', 'Nomor_BA','Tanggal_BA' ], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_User', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta'], 'integer'],
            [['Masa_Reses', 'Nama_Tempat', 'Alamat', 'Nomor_BA','Tanggal_BA'], 'string'],
            [['Tanggal_Reses'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_User' => 'Kd  User',
            'Waktu_Unduh_Absen' => 'Waktu  Unduh  Absen',
            'Waktu_Unduh_Berita_Acara' => 'Waktu  Unduh  Berita  Acara',
            'Waktu_Mulai' => 'Waktu  Mulai',
            'Waktu_Selesai' => 'Waktu  Selesai',
            'Masa_Reses' => 'Masa  Reses',
            'Tanggal_Reses' => 'Tanggal  Reses',
            'Nama_Tempat' => 'Nama  Tempat',
            'Alamat' => 'Alamat',
            'Jumlah_Peserta' => 'Jumlah  Peserta',
			'Nomor_BA' => 'Nomor Berita Acara',
			'Tanggal_BA' => 'Tanggal Berita Acara',
        ];
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaPokirAcaraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaPokirAcaraQuery(get_called_class());
    }
}
