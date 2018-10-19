<?php

namespace common\models;

use Yii;
use common\models\RefSubUnit;
use common\models\TaPaguProgram;
use common\models\RefUnit;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaBelanjaRincSubRancangan;
use emusrenbang\models\TaBelanjaRincSubRancanganAkhir;
use emusrenbang\models\TaBelanjaRincSubProv;

/**
 * This is the model class for table "Ta_Sub_Unit".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $Nm_Pimpinan
 * @property string $Nip_Pimpinan
 * @property string $Jbt_Pimpinan
 * @property string $Alamat
 * @property string $Ur_Visi
 *
 * @property TaMisi[] $taMisis
 * @property RefUnit $kdUrusan
 * @property TaTupok[] $taTupoks
 */
class TaSubUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Sub_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Pimpinan'], 'string', 'max' => 50],
            [['Nip_Pimpinan'], 'string', 'max' => 21],
            [['Jbt_Pimpinan'], 'string', 'max' => 75],
            [['Alamat', 'Ur_Visi'], 'string', 'max' => 255],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'exist', 'skipOnError' => true, 'targetClass' => RefUnit::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Bidang',
            'Kd_Unit' => 'Unit',
            'Kd_Sub' => 'Sub Unit',
            'Nm_Pimpinan' => 'Nama  Pimpinan',
            'Nip_Pimpinan' => 'NIP  Pimpinan',
            'Jbt_Pimpinan' => 'Jabatan  Pimpinan',
            'Alamat' => 'Alamat',
            'Ur_Visi' => 'Visi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMisis()
    {
        return $this->hasMany(TaMisi::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getTaPrograms()
    {
        return $this->hasMany(TaProgram::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTupoks()
    {
        return $this->hasMany(TaTupok::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getKdSubUnit() 
    
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }   

    public function getUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getKdBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }


     public function getNamaSub()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit', 'Kd_Sub'=>'Kd_Sub']);
    }

    public function getPaguPrograms()
    {
        return $this->hasMany(TaPaguProgram::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit', 'Kd_Sub'=>'Kd_Sub']);
    }

    public function getPaguSubUnit()
    {
        return $this->hasOne(TaPaguSubUnit::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit', 'Kd_Sub'=>'Kd_Sub']);
    }


    public function  getUnit()

    {
        return $this->hasOne(RefUnit::classname(),['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit']);

    }

    public function getBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }
	
	public function getBelanjaRincSubsRancangan()
    {
        return $this->hasMany(TaBelanjaRincSubRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }
	
	public function getBelanjaRincSubsRancanganAkhir()
    {
        return $this->hasMany(TaBelanjaRincSubRancanganAkhir::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

      public function getKegiatans()
    {
        return $this->hasMany(TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }
	
	public function getKegiatansRancangan()
    {
        return $this->hasMany(TaKegiatanRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }
	
	public function getKegiatansRancanganAwal()
    {
        return $this->hasMany(TaKegiatanRancanganAwal::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }
	
	public function getKegiatansRancanganAkhir()
    {
        return $this->hasMany(TaKegiatanRancanganAkhir::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }



     public function getBelanjaProv()
    {
        return $this->hasMany(TaBelanjaRincSubProv::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaSubUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaSubUnitQuery(get_called_class());
    }
}
