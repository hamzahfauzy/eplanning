<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Bank".
 *
 * @property integer $Kd_Bank
 * @property string $Nm_Bank
 * @property string $No_Rekening
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property integer $Kd_Rek_5
 */
class RefBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Bank', 'Nm_Bank', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'required'],
            [['Kd_Bank', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'integer'],
            [['Nm_Bank', 'No_Rekening'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Bank' => 'Kd  Bank',
            'Nm_Bank' => 'Nm  Bank',
            'No_Rekening' => 'No  Rekening',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefBankQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefBankQuery(get_called_class());
    }
}
