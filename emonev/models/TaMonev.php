<?php

namespace emonev\models;

use yii\db\ActiveRecord;
use common\models\RefKegiatan;
use common\models\RefProgram;
use common\models\RefStandardSatuan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;

class TaMonev extends ActiveRecord
{
	public static function tableName()
    {
        return 'Ta_Monev';
    }

    public function getKegiatan()
    {
        return $this->hasOne(RefKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit','Kd_Sub_Unit' => 'Kd_Sub','Kd_Prog' => 'Kd_Prog','Kd_Keg' => 'Kd_Keg']);
    }

    public function getProgram()
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit','Kd_Sub_Unit' => 'Kd_Sub','Kd_Prog' => 'Kd_Prog']);
    }

    public function getSatuan()
    {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Satuan']);
    }

    public function getUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getUnit()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit']);
    }

    public function getSub()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang' => 'Kd_Bidang','Kd_Unit' => 'Kd_Unit','Kd_Sub' => 'Kd_Sub']);
    }
}