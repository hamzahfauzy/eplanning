<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kegiatans".
 *
 * @property integer $id
 * @property string $kode_kegiatan
 * @property string $kode_program
 * @property string $nama_kegiatan
 * @property string $indikator
 * @property string $status
 * @property string $aktif
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Kegiatans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kegiatans';
    }
    public $nama_program;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_program', 'nama_kegiatan'], 'required'],
            [['status', 'aktif'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['kode_kegiatan', 'kode_program'], 'string', 'max' => 50],
            [['nama_kegiatan', 'indikator'], 'string', 'max' => 255],
            [['kode_kegiatan'], 'unique'],
            [['nama_program'], 'safe'],
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
            'kode_program' => 'Kode Program',
            'nama_kegiatan' => 'Nama Kegiatan',
            'indikator' => 'Indikator',
            'status' => 'Status',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'nama_program' => 'Program',
        ];
    }
}
