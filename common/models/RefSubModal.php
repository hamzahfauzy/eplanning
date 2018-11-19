<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Sub_Modal".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property integer $Kd_Rek_5
 * @property integer $Kd_Sub_Modal
 * @property string $Nm_Sub_Modal
 */
class RefSubModal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sub_Modal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Sub_Modal', 'Nm_Sub_Modal'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Sub_Modal'], 'integer'],
            [['Nm_Sub_Modal'], 'string', 'max' => 255],
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
            'Kd_Sub_Modal' => 'Kd  Sub  Modal',
            'Nm_Sub_Modal' => 'Nm  Sub  Modal',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSubModalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSubModalQuery(get_called_class());
    }
}
