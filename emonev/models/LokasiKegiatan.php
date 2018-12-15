<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lokasi_kegiatan".
 *
 * @property integer $id
 * @property string $lokasi
 */
class LokasiKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lokasi_kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lokasi'], 'required'],
            [['lokasi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lokasi' => 'Lokasi',
        ];
    }
}
