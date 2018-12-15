<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "uraian_kegiatan".
 *
 * @property integer $id
 * @property string $kode_kegiatan
 * @property string $kode_skpd
 * @property string $tahun
 * @property string $jenis
 * @property string $uraian
 * @property string $volume
 * @property string $satuan
 * @property integer $harga
 * @property integer $jumlah
 * @property integer $total
 * @property string $keterangan
 * @property string $save_status
 * @property string $username
 */
class UraianKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uraian_kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_kegiatan', 'kode_skpd', 'uraian', 'volume', 'satuan', 'harga', 'total', 'keterangan'], 'required'],
            [['uraian', 'keterangan'], 'string'],
            [['harga', 'jumlah', 'total'], 'integer'],
            [['kode_kegiatan', 'kode_skpd', 'save_status', 'username'], 'string', 'max' => 100],
            [['tahun'], 'string', 'max' => 4],
            [['jenis'], 'string', 'max' => 20],
            [['volume', 'satuan'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_kegiatan' => 'Kode Kegiatan',
            'kode_skpd' => 'Kode Skpd',
            'tahun' => 'Tahun',
            'jenis' => 'Jenis',
            'uraian' => 'Uraian',
            'volume' => 'Volume',
            'satuan' => 'Satuan',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'total' => 'Total',
            'keterangan' => 'Keterangan',
            'save_status' => 'Save Status',
            'username' => 'Username',
        ];
    }
}
