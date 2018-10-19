<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Asb4".
 *
 * @property integer $Kd_Asb1
 * @property integer $Kd_Asb2
 * @property integer $Kd_Asb3
 * @property integer $Kd_Asb4
 * @property string $Nm_Asb4
 *
 * @property RefAsb[] $refAsbs
 * @property RefAsb3 $kdAsb1
 */
class RefAsb4 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Asb4';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4'], 'required'],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4'], 'integer'],
            [['Nm_Asb4'], 'string', 'max' => 255],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3'], 'exist', 'skipOnError' => true, 'targetClass' => RefAsb3::className(), 'targetAttribute' => ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Asb1' => 'Kode ASB 1',
            'Kd_Asb2' => 'Kode ASB 2',
            'Kd_Asb3' => 'Kode ASB 3',
            'Kd_Asb4' => 'Kode ASB 4',
            'Nm_Asb4' => 'Uraian ASB 4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAsbs()
    {
        return $this->hasMany(RefAsb::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAsb1()
    {
        return $this->hasOne(RefAsb3::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAsb4Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAsb4Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Asb1.".".$this->Kd_Asb2.".".$this->Kd_Asb3.".".$this->Kd_Asb4;
    }
}
