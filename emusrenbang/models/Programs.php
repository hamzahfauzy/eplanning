<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "programs".
 *
 * @property integer $id
 * @property string $id_prioritas
 * @property string $nama_program
 * @property string $indikator_program
 * @property string $status
 * @property string $aktif
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Programs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $nawacita;
    public static function tableName()
    {
        return 'programs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_program', 'indikator_program', 'status', 'urusan', 'misi'], 'required'],
            [['status', 'aktif'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['id_prioritas'], 'string', 'max' => 50],
            [['nama_program', 'indikator_program'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_prioritas' => 'Prioritas Nasional',
            'nama_program' => 'Nama Program',
            'indikator_program' => 'Indikator Program',
            'status' => 'Status',
            'aktif' => 'Aktif',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'urusan' => 'Urusan',
            'misi' => 'Misi',
        ];
    }
}
