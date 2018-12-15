<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_kegiatan".
 *
 * @property integer $id
 * @property string $kode_kegiatan
 * @property string $tahun
 * @property string $lokasi
 * @property string $target
 * @property integer $pagu
 * @property string $sumber
 * @property string $catatan
 * @property string $prakiraan_target
 * @property integer $prakiraan_pagu
 * @property string $username
 * @property string $kode_skpd
 * @property string $create_at
 * @property string $save_status
 * @property string $kategori
 * @property string $file
 * @property string $map
 */
class DetailKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_kegiatan';
    }
    public $nama_kegiatan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_kegiatan', 'lokasi', 'target', 'pagu', 'sumber', 'catatan', 'kode_skpd'], 'required'],
            [['pagu', 'prakiraan_pagu'], 'integer'],
            [['create_at'], 'safe'],
            [['kode_kegiatan', 'sumber', 'username', 'kode_skpd'], 'string', 'max' => 50],
            [['tahun'], 'string', 'max' => 4],
            [['lokasi', 'target', 'prakiraan_target', 'save_status', 'kategori', 'file', 'map'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 200],
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
            'tahun' => 'Tahun',
            'lokasi' => 'Lokasi',
            'target' => 'Target',
            'pagu' => 'Pagu',
            'sumber' => 'Sumber',
            'catatan' => 'Keterangan',
            'prakiraan_target' => 'Prakiraan Target',
            'prakiraan_pagu' => 'Prakiraan Pagu',
            'username' => 'Username',
            'kode_skpd' => 'Kode Skpd',
            'create_at' => 'Create At',
            'save_status' => 'Save Status',
            'kategori' => 'Kategori',
            'file' => 'File',
            'map' => 'Map',
        ];
    }
}
