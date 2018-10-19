<?php

namespace common\models;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use Yii;

/**
 * This is the model class for table "Ref_Program".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Prog
 * @property string $Ket_Program
 *
 * @property RefKegiatan[] $refKegiatans
 * @property RefBidang $kdUrusan
 * @property TaProgram[] $taPrograms
 */
class RefProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Ket_Program','Kd_Unit','Kd_Sub_Unit'], 'required'],
            [['Kd_Urusan',  'Kd_Prog','Kd_Unit','Kd_Sub_Unit'], 'integer'],
            [['Kd_Bidang','Ket_Program'], 'string', 'max' => 255],
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
			'Kd_Unit' => 'Unit Kerja',
			'Kd_Sub_Unit' => 'Sub Unit',
            'Kd_Prog' => 'Kode  Program',
            'Ket_Program' => 'Keterangan  Program',
			
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKegiatans()
    {
        return $this->hasMany(RefKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }
	
	public function getKdUnit()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit']);
    }
	public function getKdSub()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit','Kd_Sub' => 'Kd_Sub_Unit']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPrograms()
    {
        return $this->hasMany(TaProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    }

    public static function find()
    {
        return new \common\models\query\RefProgramQuery(get_called_class());
    }
}
