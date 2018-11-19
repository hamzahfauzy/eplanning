<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefKelurahan;
/**
 * This is the model class for table "Ta_Agenda_Perencanaan_Kelurahan".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property string $Tanggal
 * @property string $Jam
 * @property string $Keterangan
 *
 * @property RefKelurahan $kdProv
 */
class TaAgendaPerencanaanKelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Agenda_Perencanaan_Kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Tanggal', 'Jam', 'Keterangan'], 'required'],
            [['Tahun', 'Tanggal', 'Jam'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel'], 'integer'],
            [['Keterangan'], 'string'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Kel' => 'Kd  Kel',
            'Tanggal' => 'Tanggal',
            'Jam' => 'Jam',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaAgendaPerencanaanKelurahanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaAgendaPerencanaanKelurahanQuery(get_called_class());
    }
}
