<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Asb3".
 *
 * @property integer $Kd_Asb1
 * @property integer $Kd_Asb2
 * @property integer $Kd_Asb3
 * @property string $Nm_Asb3
 *
 * @property RefAsb2 $kdAsb1
 * @property RefAsb4[] $refAsb4s
 */
class RefAsb3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Asb3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3'], 'required'],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3'], 'integer'],
            [['Nm_Asb3'], 'string', 'max' => 255],
            [['Kd_Asb1', 'Kd_Asb2'], 'exist', 'skipOnError' => true, 'targetClass' => RefAsb2::className(), 'targetAttribute' => ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2']],
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
            'Nm_Asb3' => 'Uraian ASB 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAsb1()
    {
        return $this->hasOne(RefAsb2::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAsb4s()
    {
        return $this->hasMany(RefAsb4::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAsb3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAsb3Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Asb1.".".$this->Kd_Asb2.".".$this->Kd_Asb3;
    }
}
