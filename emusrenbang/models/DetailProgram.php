<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_program".
 *
 * @property string $kode_program
 * @property string $tahun
 * @property string $lokasi
 * @property string $target
 * @property integer $pagu
 * @property string $sumber
 * @property string $catatan
 * @property string $prakiraan_target
 * @property integer $prakiraan_pagu
 * @property string $username
 * @property string $created_at
 */
class DetailProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_program', 'tahun', 'lokasi', 'target', 'pagu', 'sumber', 'catatan', 'prakiraan_target', 'prakiraan_pagu', 'username'], 'required'],
            [['pagu', 'prakiraan_pagu'], 'integer'],
            [['created_at'], 'safe'],
            [['kode_program', 'sumber', 'username'], 'string', 'max' => 50],
            [['tahun'], 'string', 'max' => 4],
            [['lokasi', 'target', 'prakiraan_target'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode_program' => 'Kode Program',
            'tahun' => 'Tahun',
            'lokasi' => 'Lokasi',
            'target' => 'Target',
            'pagu' => 'Pagu',
            'sumber' => 'Sumber',
            'catatan' => 'Catatan',
            'prakiraan_target' => 'Prakiraan Target',
            'prakiraan_pagu' => 'Prakiraan Pagu',
            'username' => 'Username',
            'created_at' => 'Created At',
        ];
    }
}
