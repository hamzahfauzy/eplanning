<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "usulans".
 *
 * @property integer $id
 * @property integer $id_program
 * @property integer $id_satuan
 * @property integer $id_skpd
 * @property integer $id_kegiatan
 * @property string $indikator
 * @property string $target
 * @property integer $jenis
 * @property integer $harga
 * @property string $keterangan
 * @property integer $id_user
 * @property string $date
 * @property string $time
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Usulans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usulans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_program', 'id_satuan', 'id_skpd', 'id_kegiatan', 'indikator', 'target', 'jenis', 'harga', 'keterangan', 'id_user', 'date', 'time'], 'required'],
            [['id_program', 'id_satuan', 'id_skpd', 'id_kegiatan', 'jenis', 'harga', 'id_user'], 'integer'],
            [['date', 'time', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['indikator', 'target', 'keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_program' => 'Id Program',
            'id_satuan' => 'Id Satuan',
            'id_skpd' => 'Id Skpd',
            'id_kegiatan' => 'Id Kegiatan',
            'indikator' => 'Indikator',
            'target' => 'Target',
            'jenis' => 'Jenis',
            'harga' => 'Harga',
            'keterangan' => 'Keterangan',
            'id_user' => 'Id User',
            'date' => 'Date',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
