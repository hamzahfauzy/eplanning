<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kegiatan".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 * @property string $Ket_Kegiatan
 *
 * @property RefJenisUsulan[] $refJenisUsulans
 * @property RefProgram $kdUrusan
 */
class RefKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Ket_Kegiatan','Kd_Unit','Kd_Sub_Unit','Indikator','Satuan0','Target0','Pagu_Indikatif','Target1','Tahun_Pertama','Target2','Tahun_Kedua','Target3','Tahun_Ketiga','Target4','Tahun_Keempat','Target5','Tahun_Kelima','Target6','Tahun_Akhir'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg','Kd_Unit','Kd_Sub_Unit',], 'integer'],
			[['Target0','Pagu_Indikatif','Target1','Tahun_Pertama','Target2','Tahun_Kedua','Target3','Tahun_Ketiga','Target4','Tahun_Keempat','Target5','Tahun_Kelima','Target6','Tahun_Akhir'],'number'],
            [['Ket_Kegiatan','Indikator','Satuan0'], 'string'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => RefProgram::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']],
	  
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
            'Kd_Prog' => 'Kode  Program',
            'Kd_Keg' => 'Kode  Kegiatan',
            'Ket_Kegiatan' => 'Kegiatan',
			'Kd_Unit' => 'Kode Unit',
			'Kd_Sub_Unit' => 'Kode Sub Unit',
			'Indikator'=>'Indikator Kegiatan',
'Satuan0'=> 'Satuan',
'Target0'=> 'Target Tahun 2016',
	    'Pagu_Indikatif' => 'Pagu Tahun 2016 (Rp.)',
'Target1'=> 'Target Tahun 2017',
	    'Tahun_Pertama' => 'Pagu Tahun 2017 (Rp.)',
'Target2'=> 'Target Tahun 2018',
	    'Tahun_Kedua'=> 'Pagu Tahun 2018 (Rp.)',
'Target3'=> 'Target Tahun 2019',
	    'Tahun_Ketiga'=> 'Pagu Tahun 2019 (Rp.)',
'Target4'=> 'Target Tahun 2020',
	    'Tahun_Keempat'=> 'Pagu Tahun 2020 (Rp.)',
'Target5'=> 'Target Tahun 2021',
	    'Tahun_Kelima'=> 'Pagu Tahun 2021 (Rp.)',
'Target6'=> 'Target Tahun Akhir',
	    'Tahun_Akhir'=> 'Pagu Tahun Akhir (Rp.)', 
	    
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisUsulans()
    {
        return $this->hasMany(RefJenisUsulan::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    }

    public function getUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

	public function getUnit()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit']);
    }
	public function getSub()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit','Kd_Sub' => 'Kd_Sub_Unit']);
    }
	
    public function getProgram()
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    }

public function getSatuan()
    {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Satuan0']);
    }




    /**
     * @inheritdoc
     * @return \common\models\query\RefKegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKegiatanQuery(get_called_class());
    }
}
