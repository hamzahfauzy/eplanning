<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Analisa_Sub".
 *
 * @property integer $Kd_Analisa
 * @property integer $Kd_Analisa_Sub
 * @property string $Nm_Analisa_Sub
 *
 * @property RefAnalisa $kdAnalisa
 * @property RefAnalisaSubA[] $refAnalisaSubAs
 */
class RefAnalisaSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Analisa_Sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Analisa', 'Kd_Analisa_Sub'], 'required'],
            [['Kd_Analisa', 'Kd_Analisa_Sub'], 'integer'],
            [['Nm_Analisa_Sub'], 'string', 'max' => 100],
            [['Kd_Analisa'], 'exist', 'skipOnError' => true, 'targetClass' => RefAnalisa::className(), 'targetAttribute' => ['Kd_Analisa' => 'Kd_Analisa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Analisa' => 'Kode  Analisa',
            'Kd_Analisa_Sub' => 'Kode Sub Analisa',
            'Nm_Analisa_Sub' => 'Sub Analisa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAnalisa()
    {
        return $this->hasOne(RefAnalisa::className(), ['Kd_Analisa' => 'Kd_Analisa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAnalisaSubAs()
    {
        return $this->hasMany(RefAnalisaSubA::className(), ['Kd_Analisa' => 'Kd_Analisa', 'Kd_Analisa_Sub' => 'Kd_Analisa_Sub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAnalisaSubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAnalisaSubQuery(get_called_class());
    }
}
