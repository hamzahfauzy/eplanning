<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class ZulTanggal extends Component {

    public function ZULgetbulan($id) {
        switch ($id) {
            case 1: return "Januari";
                break;
            case 2: return "Februari";
                break;
            case 3: return "Maret";
                break;
            case 4: return "April";
                break;
            case 5: return "Mei";
                break;
            case 6: return "Juni";
                break;
            case 7: return "Juli";
                break;
            case 8: return "Agustus";
                break;
            case 9: return "September";
                break;
            case 10: return "Oktober";
                break;
            case 11: return "November";
                break;
            default: return "Desember";
        }
    }

    public function ZULgethari($id) {
        switch ($id) {
            case 1: return "Senin";
                break;
            case 2: return "Selasa";
                break;
            case 3: return "Rabu";
                break;
            case 4: return "Kamis";
                break;
            case 5: return "Jumat";
                break;
            case 6: return "Sabtu";
                break;
            default: return "Minggu";
        }
    }

    public function ZULgetcurrency($id) {
        if ($id == 0) {
            return '0';
        }
        $str = '';
        $temp = 0;
        while ($id >= 1000) {
            $temp = $id % 1000;
            $str = '.' . str_pad($temp, 3, "0", STR_PAD_LEFT) . $str;
            $id = (int) ($id / 1000);
        }
        return $id . $str . ',00';
    }

}

?>