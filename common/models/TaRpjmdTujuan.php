<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Rpjmd_Tujuan".
 *
 * @property string $Tahun
 * @property int $No_Misi
 * @property int $No_Tujuan
 * @property string $Tujuan
 *
 * @property TaRpjmdSasaran[] $taRpjmdSasarans
 * @property TaRpjmdMisi $tahun
 */
class TaRpjmdTujuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Rpjmd_Tujuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Misi', 'No_Tujuan', 'Tujuan'], 'required'],
            [['Tahun'], 'safe'],
            [['No_Misi', 'No_Tujuan'], 'integer'],
            [['Tujuan'], 'string'],
            [['Tahun', 'No_Misi'], 'exist', 'skipOnError' => true, 'targetClass' => TaRpjmdMisi::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi']],
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
            'Tujuan' => 'Tujuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdSasarans()
    {
        return $this->hasMany(TaRpjmdSasaran::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdMisi()
    {
        return $this->hasOne(TaRpjmdMisi::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaRpjmdTujuanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaRpjmdTujuanQuery(get_called_class());
    }
}
