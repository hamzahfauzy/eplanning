<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Rpjmd_Prioritas_Pembangunan_Daerah".
 *
 * @property string $Tahun
 * @property int $No_Prioritas
 * @property string $Prioritas_Pembangunan_Daerah
 *
 * @property TaRpjmdProgramPrioritas[] $taRpjmdProgramPrioritas
 */
class TaRpjmdPrioritasPembangunanDaerah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Rpjmd_Prioritas_Pembangunan_Daerah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Prioritas', 'Prioritas_Pembangunan_Daerah'], 'required'],
            [['Tahun'], 'safe'],
            [['No_Prioritas'], 'integer'],
            [['Prioritas_Pembangunan_Daerah'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'No_Prioritas' => 'No  Prioritas',
            'Prioritas_Pembangunan_Daerah' => 'Prioritas  Pembangunan  Daerah',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getTaRpjmdProgramPrioritas()
    {
        return $this->hasMany(TaRpjmdProgramPrioritas::className(), ['Tahun' => 'Tahun', 'No_Prioritas' => 'No_Prioritas']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaRpjmdPrioritasPembangunanDaerahQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaRpjmdPrioritasPembangunanDaerahQuery(get_called_class());
    }
}
