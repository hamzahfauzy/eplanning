<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Analisa_Sub_A".
 *
 * @property integer $Kd_Analisa
 * @property integer $Kd_Analisa_Sub
 * @property integer $Kd_Analisa_Sub_A
 * @property string $Nm_Analisa_Sub_A
 *
 * @property RefAnalisaSub $kdAnalisa
 */
class RefAnalisaSubA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Analisa_Sub_A';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Analisa', 'Kd_Analisa_Sub', 'Kd_Analisa_Sub_A'], 'required'],
            [['Kd_Analisa', 'Kd_Analisa_Sub', 'Kd_Analisa_Sub_A'], 'integer'],
            [['Nm_Analisa_Sub_A'], 'string', 'max' => 100],
            [['Kd_Analisa', 'Kd_Analisa_Sub'], 'exist', 'skipOnError' => true, 'targetClass' => RefAnalisaSub::className(), 'targetAttribute' => ['Kd_Analisa' => 'Kd_Analisa', 'Kd_Analisa_Sub' => 'Kd_Analisa_Sub']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Analisa' => 'Kode  Analisa',
            'Kd_Analisa_Sub' => 'Kode  Analisa  Sub',
            'Kd_Analisa_Sub_A' => 'Kode  Analisa  Sub  A',
            'Nm_Analisa_Sub_A' => 'Analisa  Sub  A',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAnalisa()
    {
        return $this->hasOne(RefAnalisaSub::className(), ['Kd_Analisa' => 'Kd_Analisa', 'Kd_Analisa_Sub' => 'Kd_Analisa_Sub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAnalisaSubAQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAnalisaSubAQuery(get_called_class());
    }
}
