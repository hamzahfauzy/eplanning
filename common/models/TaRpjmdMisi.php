<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Rpjmd_Misi".
 *
 * @property string $Tahun
 * @property int $No_Misi
 * @property string $Misi
 *
 * @property TaRpjmdTujuan[] $taRpjmdTujuans
 */
class TaRpjmdMisi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Rpjmd_Misi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Misi', 'Misi'], 'required'],
            [['Tahun'], 'safe'],
            [['No_Misi'], 'integer'],
            [['Misi'], 'string'],
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
            'Misi' => 'Misi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdTujuans()
    {
        return $this->hasMany(TaRpjmdTujuan::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaRpjmdMisiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaRpjmdMisiQuery(get_called_class());
    }
}
