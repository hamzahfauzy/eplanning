<?php

namespace common\models;

use Yii;
use common\models\TaProgram;
use common\models\TaKegiatan;
use common\models\TaProgramProv;
use common\models\MusrembangSkpdAcara;

use common\models\TaPaguSubUnit;

use emusrenbang\models\TaBelanjaRincSub;
/**
 * This is the model class for table "Ref_Sub_Unit".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $Nm_Sub_Unit
 *
 * @property RefUnit $kdUrusan
 */
class RefSubUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sub_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Nm_Sub_Unit'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Sub_Unit'], 'string', 'max' => 255],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'exist', 'skipOnError' => true, 'targetClass' => RefUnit::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']],
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
            'Kd_Unit' => 'Kode  Unit',
            'Kd_Sub' => 'Kode Sub Unit',
            'Nm_Sub_Unit' => 'Nama Sub Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

     public function getKdBidang()
    {
        return $this->hasOne(\common\models\RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

     public function getUrusan()
    {
        return $this->hasOne(\common\models\RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }
	
	public function getTaMusrenbangSkpdAcara()
    {
        return $this->hasOne(MusrenbangSkpdAcara::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub_Unit' => 'Kd_Sub']);
    }

    public function getTaPrograms()
    {
        return $this->hasMany(TaProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getTaProgramProvs()
    {
        return $this->hasMany(TaProgramProv::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }


    /**
     * @inheritdoc
     * @return \common\models\query\RefSubUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSubUnitQuery(get_called_class());
    }
}
