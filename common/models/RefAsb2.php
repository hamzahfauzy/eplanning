<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Asb2".
 *
 * @property integer $Kd_Asb1
 * @property integer $Kd_Asb2
 * @property string $Nm_Asb2
 *
 * @property RefAsb1 $kdAsb1
 * @property RefAsb3[] $refAsb3s
 */
class RefAsb2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Asb2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2'], 'required'],
            [['Kd_Asb1', 'Kd_Asb2'], 'integer'],
            [['Nm_Asb2'], 'string', 'max' => 255],
            [['Kd_Asb1'], 'exist', 'skipOnError' => true, 'targetClass' => RefAsb1::className(), 'targetAttribute' => ['Kd_Asb1' => 'Kd_Asb1']],
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
            'Nm_Asb2' => 'Uraian ASB 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAsb1()
    {
        return $this->hasOne(RefAsb1::className(), ['Kd_Asb1' => 'Kd_Asb1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAsb3s()
    {
        return $this->hasMany(RefAsb3::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAsb2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAsb2Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Asb1.".".$this->Kd_Asb2;
    }
}
