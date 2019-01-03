<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TahunBerjalan
 *
 * @author webmaxindo
 */

namespace common\components;

use Yii;
use yii\base\Component;
use common\models\TaPemda;
use common\models\RefProvinsi;


class Pengaturan extends Component {

	private $tahun = 2019;

	public function getTahun() {
		return TaPemda::findone(['Tahun'=>$this->tahun])->Tahun;
  }

	public function Kolom($kol) {
		return TaPemda::findone(['Tahun'=>$this->tahun])->$kol;
  }

	public function nmProvinsi() {
		$Kd_Prov = TaPemda::findone(['Tahun'=>$this->tahun])->Kd_Prov;

		$Nm_Prov = RefProvinsi::findone(['Kd_Prov'=>$Kd_Prov])->Nm_Prov;
		return $Nm_Prov;
  }
  public function kdProvinsi() {
		return TaPemda::findone(['Tahun'=>$this->tahun])->Kd_Prov;
  }

}