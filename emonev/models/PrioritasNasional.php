<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "prioritas_nasional".
 *
 * @property integer $id
 * @property integer $id_nawacita
 * @property string $prioritas_nasional
 * @property string $tahun
 */
class PrioritasNasional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $namaNawacita;

    public static function tableName()
    {
        return 'prioritas_nasional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nawacita', 'prioritas_nasional', 'tahun'], 'required'],
            [['id_nawacita'], 'integer'],
            [['prioritas_nasional'], 'string', 'max' => 255],
            [['tahun'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nawacita' => 'Nawacita',
            'namaNawacita' => 'Nawacita',
            'prioritas_nasional' => 'Prioritas Nasional',
            'tahun' => 'Tahun',
        ];
    }
}
