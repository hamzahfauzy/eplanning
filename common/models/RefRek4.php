<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Rek_4".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property string $Nm_Rek_4
 *
 * @property RefRek3 $kdRek1
 * @property RefRek5[] $refRek5s
 */
class RefRek4 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Rek_4';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Nm_Rek_4'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4'], 'integer'],
            [['Nm_Rek_4'], 'string', 'max' => 100],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3'], 'exist', 'skipOnError' => true, 'targetClass' => RefRek3::className(), 'targetAttribute' => ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3']],
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
            'Nm_Rek_4' => 'Nm  Rek 4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdRek1()
    {
        return $this->hasOne(RefRek3::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRek5s()
    {
        return $this->hasMany(RefRek5::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefRek4Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefRek4Query(get_called_class());
    }
}
