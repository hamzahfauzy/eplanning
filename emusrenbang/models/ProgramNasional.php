<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "program_nasional".
 *
 * @property string $id_prioritas
 * @property string $id_nawacita
 * @property string $id_urusan
 * @property string $id_misi
 * @property string $urusan
 * @property string $bidang
 * @property string $id_program
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 * @property string $tahun
 */
class ProgramNasional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namaPrioritas;
    public $namaNawacita;
    public $namaMisi;
    public $namaUrusan;

    public $misi;
    public $nawacita;

    public static function tableName()
    {
        return 'program_nasional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prioritas', 'id_nawacita', 'id_urusan', 'id_misi', 'urusan', 'bidang', 'id_program', 'created_at', 'updated_at', 'username', 'tahun'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['id_prioritas', 'id_nawacita', 'id_urusan', 'id_misi', 'urusan', 'bidang', 'id_program', 'username'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prioritas' => 'Prioritas Nasional',
            'namaPrioritas' => 'Prioritas Nasional',
            'namaNawacita' => 'Nawacita',
            'namaMisi' => 'Visi Misi',
            'namaUrusan' => 'Urusan Provinsi',
            'id_nawacita' => 'Nawacita',
            'id_urusan' => 'Kode Urusan',
            'id_misi' => 'Visi Misi',
            'urusan' => 'Urusan',
            'bidang' => 'Sektor',
            'id_program' => 'Kode Program',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
            'tahun' => 'Tahun',
        ];
    }

    public function getProgramNasional()
    {
        return $this->hasMany(PrioritasNasional::className(), ['id_nawacita' => 'id_nawacita','tahun' => 'tahun']);
    }

}
