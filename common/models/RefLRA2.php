<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_LRA_2".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property string $Nm_Rek_2
 *
 * @property RefLRA1 $kdRek1
 * @property RefLRA3[] $refLRA3s
 */
class RefLRA2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_LRA_2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Nm_Rek_2'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2'], 'integer'],
            [['Nm_Rek_2'], 'string', 'max' => 100],
            [['Kd_Rek_1'], 'exist', 'skipOnError' => true, 'targetClass' => RefLRA1::className(), 'targetAttribute' => ['Kd_Rek_1' => 'Kd_Rek_1']],
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
            'Nm_Rek_2' => 'Nm  Rek 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdRek1()
    {
        return $this->hasOne(RefLRA1::className(), ['Kd_Rek_1' => 'Kd_Rek_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefLRA3s()
    {
        return $this->hasMany(RefLRA3::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefLRA2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefLRA2Query(get_called_class());
    }
}
