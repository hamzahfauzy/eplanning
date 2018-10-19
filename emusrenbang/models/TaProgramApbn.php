<?php

namespace emusrenbang\models;

use Yii;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefProgram;
use emusrenbang\models\TaBelanjaRincSubApbn;

/**
 * This is the model class for table "Ta_Program_Apbn".
 *
 * @property string $Tahun
 * @property int $Kd_Urusan untuk filter / kode skpd
 * @property int $Kd_Bidang untuk filter / koda skpd
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property string $Ket_Prog
 * @property string $Tolak_Ukur
 * @property double $Target_Angka
 * @property string $Target_Uraian
 * @property int $Kd_Urusan1 untuk filter per program
 * @property int $Kd_Bidang1 untuk filter per program
 */
class TaProgramApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Program_Apbn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Ket_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'integer'],
            [['Target_Angka'], 'number'],
            [['Ket_Prog', 'Tolak_Ukur', 'Target_Uraian'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Ket_Prog' => 'Ket  Prog',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Angka' => 'Target  Angka',
            'Target_Uraian' => 'Target  Uraian',
            'Kd_Urusan1' => 'Kd  Urusan1',
            'Kd_Bidang1' => 'Kd  Bidang1',
        ];
    }
	
	 public function getTaKegiatans()
    {
        return $this->hasMany(TaKegiatanApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }


    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaProgramApbnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaProgramApbnQuery(get_called_class());
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

    public function getRefProgram()
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    }

	 public function getBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSubApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

	
    public function getKegiatans()
    {
        return $this->hasMany(TaKegiatanApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

}
