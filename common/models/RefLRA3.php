<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_LRA_3".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property string $Nm_Rek_3
 *
 * @property RefLRA2 $kdRek1
 * @property RefLRA4[] $refLRA4s
 */
class RefLRA3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_LRA_3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Nm_Rek_3'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3'], 'integer'],
            [['Nm_Rek_3'], 'string', 'max' => 100],
            [['Kd_Rek_1', 'Kd_Rek_2'], 'exist', 'skipOnError' => true, 'targetClass' => RefLRA2::className(), 'targetAttribute' => ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']],
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
            'Nm_Rek_3' => 'Nm  Rek 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdRek1()
    {
        return $this->hasOne(RefLRA2::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefLRA4s()
    {
        return $this->hasMany(RefLRA4::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefLRA3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefLRA3Query(get_called_class());
    }
}
