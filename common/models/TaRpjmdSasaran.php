<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Rpjmd_Sasaran".
 *
 * @property string $Tahun
 * @property int $No_Misi
 * @property int $No_Tujuan
 * @property int $No_Sasaran
 * @property string $Sasaran
 *
 * @property TaRpjmdProgramPrioritas[] $taRpjmdProgramPrioritas
 * @property TaRpjmdTujuan $tahun
 */
class TaRpjmdSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Rpjmd_Sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'required'],
            [['Tahun'], 'safe'],
            [['No_Misi', 'No_Tujuan', 'No_Sasaran'], 'integer'],
            [['Sasaran'], 'string'],
            [['Tahun', 'No_Misi', 'No_Tujuan'], 'exist', 'skipOnError' => true, 'targetClass' => TaRpjmdTujuan::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Sasaran' => 'Sasaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdProgramPrioritas()
    {
        return $this->hasMany(TaRpjmdProgramPrioritas::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdTujuan()
    {
        return $this->hasOne(TaRpjmdTujuan::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaRpjmdSasaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaRpjmdSasaranQuery(get_called_class());
    }
}
