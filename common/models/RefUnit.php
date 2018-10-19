<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Unit".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property string $Nm_Unit
 *
 * @property RefSubUnit[] $refSubUnits
 * @property RefBidang $kdUrusan
 */
class RefUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Nm_Unit'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'integer'],
            [['Nm_Unit'], 'string', 'max' => 255],
            [['Kd_Urusan', 'Kd_Bidang'], 'exist', 'skipOnError' => true, 'targetClass' => RefBidang::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kode  Urusan',
            'Kd_Bidang' => 'Kode  Bidang',
            'Kd_Unit' => 'Kode Unit',
            'Nm_Unit' => 'Nama  Unit',
        ];
    }
    
    public function getId($name){
		$id = array();
		$id[0] = $this->find()->where(['Nm_Unit'=> $name])->one()->Kd_Urusan;
		$id[1] = $this->find()->where(['Nm_Unit'=> $name])->one()->Kd_Bidang;
		$id[2] = $this->find()->where(['Nm_Unit'=> $name])->one()->Kd_Unit;
		return $id;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubUnits()
    {
        return $this->hasMany(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }


    public function getTaSubUnits()
    {
        return $this->hasMany(TaSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }


   
    /**
     * @inheritdoc
     * @return \common\models\query\RefUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefUnitQuery(get_called_class());
    }
}
