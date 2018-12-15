<?php

namespace emonev\models;

use Yii;
use common\models\RefPeraturan;
use common\models\RefTahapan;

/**
 * This is the model class for table "Ta_Peraturan".
 *
 * @property string $Tahun
 * @property int $Kd_Tahapan
 * @property int $Kd_Peraturan
 * @property int $No_ID
 * @property string $No_Peraturan
 * @property string $Tgl_Peraturan
 * @property string $Uraian
 *
 * @property TaHasil[] $taHasils
 * @property RefPeraturan $kdPeraturan
 * @property RefTahapan $kdTahapan
 */
class TaPeraturan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Peraturan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Tahapan', 'Kd_Peraturan', 'No_Peraturan', 'Tgl_Peraturan', 'Uraian'], 'required'],
            [['Tahun', 'Tgl_Peraturan'], 'safe'],
            [['Kd_Tahapan', 'Kd_Peraturan', 'No_ID'], 'integer'],
            [['No_Peraturan'], 'string', 'max' => 50],
            [['Uraian'], 'string', 'max' => 1000],
            [['Kd_Peraturan'], 'exist', 'skipOnError' => true, 'targetClass' => RefPeraturan::className(), 'targetAttribute' => ['Kd_Peraturan' => 'Kd_Peraturan']],
            [['Kd_Tahapan'], 'exist', 'skipOnError' => true, 'targetClass' => RefTahapan::className(), 'targetAttribute' => ['Kd_Tahapan' => 'Kd_Tahapan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Tahapan' => 'Tahapan',
            'Kd_Peraturan' => 'Peraturan',
            'No_ID' => 'ID',
            'No_Peraturan' => 'No Peraturan',
            'Tgl_Peraturan' => 'Tgl Peraturan',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaHasils()
    {
        return $this->hasMany(TaHasil::className(), ['Tahun' => 'Tahun', 'Kd_Tahapan' => 'Kd_Tahapan', 'Kd_Peraturan' => 'Kd_Peraturan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdPeraturan()
    {
        return $this->hasOne(RefPeraturan::className(), ['Kd_Peraturan' => 'Kd_Peraturan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTahapan()
    {
        return $this->hasOne(RefTahapan::className(), ['Kd_Tahapan' => 'Kd_Tahapan']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaPeraturanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaPeraturanQuery(get_called_class());
    }
}
