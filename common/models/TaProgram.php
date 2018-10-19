<?php

namespace common\models;

use Yii;
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaBelanjaRincSubRancangan;
use emusrenbang\models\TaBelanjaRincSubRancanganAkhir;
use common\models\RefSubUnit;
use common\models\RefKegiatan;
use common\models\TaSubUnit;
use emusrenbang\models\TaPaguKegiatan;
use emusrenbang\models\TaPaguKegiatanRancanganAwal;
use emusrenbang\models\TaPaguKegiatanRancanganAkhir;

/**
 * This is the model class for table "Ta_Program".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property string $Ket_Prog
 * @property string $Tolak_Ukur
 * @property double $Target_Angka
 * @property string $Target_Uraian
 * @property integer $Kd_Urusan1
 * @property integer $Kd_Bidang1
 *
 * @property RefProgram $kdUrusan
 * @property TaSubUnit $tahun
 */
class TaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'Ta_Program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Ket_Prog'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'integer'],
            [['Target_Angka'], 'number'],
            [['Ket_Prog', 'Tolak_Ukur', 'Target_Uraian'], 'string', 'max' => 255],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => RefProgram::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'exist', 'skipOnError' => true, 'targetClass' => TaSubUnit::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']],
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
            'Kd_Prog' => 'Program',
            'ID_Prog' => 'ID  Program',
            'Ket_Prog' => 'Keterangan  Program',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Angka' => 'Target  Angka',
            'Target_Uraian' => 'Target  Uraian',
            'Kd_Urusan1' => 'Kode  Urusan1',
            'Kd_Bidang1' => 'Kode  Bidang1',
        ];
    }
    public function getTaKegiatans() {
        return $this->hasMany(TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    public function getTahun()
    {
        return $this->hasOne(TaSubUnit::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getRefUnit()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getRefSubUnit()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getRefSubUnits()
    {
        return $this->hasMany(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getRefProgram()
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    }

    public function getPagu()
    {
        return $this->hasOne(TaPaguProgram::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    public function getPagus() 
    {
        return $this->hasMany(TaPaguKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    } 
	
	public function getPaguranwal() 
    {
        return $this->hasMany(TaPaguKegiatanRancanganAwal::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    } 
	
	public function getPaguAkhir() 
    {
        return $this->hasMany(TaPaguKegiatanRancanganAkhir::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    } 

    public function getBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
	
	public function getBelanjaRincSubsRancangan()
    {
        return $this->hasMany(TaBelanjaRincSubRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
	
	public function getBelanjaRincSubsRancanganAkhir()
    {
        return $this->hasMany(TaBelanjaRincSubRancanganAkhir::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    public function getKegiatans()
    {
        return $this->hasMany(TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
	
	public function getKegiatanrancangan()
    {
        return $this->hasMany(TaKegiatanRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
	
	public function getKegiatanrancanganawal()
    {
        return $this->hasMany(TaKegiatanRancanganAwal::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
	
	public function getKegiatanrancanganakhir()
    {
        return $this->hasMany(TaKegiatanRancanganAkhir::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }
    
    public function getJlhBelanjaRincSubUnits()
    {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getTaRpjmdProgramPrioritass()
    {
        return $this->hasMany(TaRpjmdProgramPrioritas::className(), ['Kd_Prog' => 'Kd_Prog']);
    }

    public function getTaRpjmdProgramPrioritas()
    {
        return $this->hasOne(TaRpjmdProgramPrioritas::className(), ['Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @inheritdoc
     * @return TaProgramQuery the active query used by this AR class.
     */
    
    public static function find()
    {
        return new \common\models\query\TaProgramQuery(get_called_class());
    }
}
