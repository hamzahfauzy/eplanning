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
use yii\base\InvalidConfigException;
use userlevel\models\TaUserKelompok;
use userlevel\models\TaUserUnit;

class ConfigComponent extends Component {

    public $FdKd_Prov = 12;

    public $FDKd_Kab	= 9;
    
    public $FDLimit_Row = 50;

}
