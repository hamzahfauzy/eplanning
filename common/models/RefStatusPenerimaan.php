<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Status_Penerimaan".
 *
 * @property integer $Kd_Status_Penerimaan
 * @property string $Nm_Status_Penerimaan
 *
 * @property TaKelurahanVerifikasiUsulanLingkungan[] $taKelurahanVerifikasiUsulanLingkungans
 */
class RefStatusPenerimaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Status_Penerimaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Status_Penerimaan', 'Nm_Status_Penerimaan'], 'required'],
            [['Kd_Status_Penerimaan'], 'integer'],
            [['Nm_Status_Penerimaan'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Status_Penerimaan' => 'Kd  Status  Penerimaan',
            'Nm_Status_Penerimaan' => 'Nm  Status  Penerimaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaKelurahanVerifikasiUsulanLingkungans()
    {
        return $this->hasMany(TaKelurahanVerifikasiUsulanLingkungan::className(), ['Status_Penerimaan' => 'Kd_Status_Penerimaan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefStatusPenerimaanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefStatusPenerimaanQuery(get_called_class());
    }
}
