<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Akrual_Rek".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property integer $Kd_Rek_5
 * @property integer $Kd_Akrual_1
 * @property integer $Kd_Akrual_2
 * @property integer $Kd_Akrual_3
 * @property integer $Kd_Akrual_4
 * @property integer $Kd_Akrual_5
 * @property integer $Kd_AkrualD_1
 * @property integer $Kd_AkrualD_2
 * @property integer $Kd_AkrualD_3
 * @property integer $Kd_AkrualD_4
 * @property integer $Kd_AkrualD_5
 * @property integer $Kd_AkrualK_1
 * @property integer $Kd_AkrualK_2
 * @property integer $Kd_AkrualK_3
 * @property integer $Kd_AkrualK_4
 * @property integer $Kd_AkrualK_5
 */
class RefAkrualRek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Akrual_Rek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5', 'Kd_AkrualD_1', 'Kd_AkrualD_2', 'Kd_AkrualD_3', 'Kd_AkrualD_4', 'Kd_AkrualD_5', 'Kd_AkrualK_1', 'Kd_AkrualK_2', 'Kd_AkrualK_3', 'Kd_AkrualK_4', 'Kd_AkrualK_5'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'Kd_Akrual_1' => 'Kd  Akrual 1',
            'Kd_Akrual_2' => 'Kd  Akrual 2',
            'Kd_Akrual_3' => 'Kd  Akrual 3',
            'Kd_Akrual_4' => 'Kd  Akrual 4',
            'Kd_Akrual_5' => 'Kd  Akrual 5',
            'Kd_AkrualD_1' => 'Kd  Akrual D 1',
            'Kd_AkrualD_2' => 'Kd  Akrual D 2',
            'Kd_AkrualD_3' => 'Kd  Akrual D 3',
            'Kd_AkrualD_4' => 'Kd  Akrual D 4',
            'Kd_AkrualD_5' => 'Kd  Akrual D 5',
            'Kd_AkrualK_1' => 'Kd  Akrual K 1',
            'Kd_AkrualK_2' => 'Kd  Akrual K 2',
            'Kd_AkrualK_3' => 'Kd  Akrual K 3',
            'Kd_AkrualK_4' => 'Kd  Akrual K 4',
            'Kd_AkrualK_5' => 'Kd  Akrual K 5',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAkrualRekQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAkrualRekQuery(get_called_class());
    }
}
