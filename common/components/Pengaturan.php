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

	

	public function getTahun() {
		$tahun = date("Y");
		return TaPemda::findone(['Tahun'=>$tahun])->Tahun;
  }

	public function Kolom($kol) {
		$tahun = date("Y");
		return TaPemda::findone(['Tahun'=>$tahun])->$kol;
  }

	public function nmProvinsi() {
		$tahun = date("Y");
		$Kd_Prov = TaPemda::findone(['Tahun'=>$tahun])->Kd_Prov;

		$Nm_Prov = RefProvinsi::findone(['Kd_Prov'=>$Kd_Prov])->Nm_Prov;
		return $Nm_Prov;
  }
  public function kdProvinsi() {
  	$tahun = date("Y");
		return TaPemda::findone(['Tahun'=>$tahun])->Kd_Prov;
  }

}