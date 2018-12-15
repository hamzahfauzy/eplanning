<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countdown".
 *
 * @property integer $id
 * @property integer $tahun
 * @property string $start
 * @property string $finish
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 */
class Countdown extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countdown';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'start', 'finish', 'keterangan', 'created_at', 'updated_at', 'username'], 'required'],
            [['tahun'], 'integer'],
            [['start', 'finish', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string'],
            [['username'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'start' => 'Jadwal Mulai',
            'finish' => 'Jadwal Selesai',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
        ];
    }
}
