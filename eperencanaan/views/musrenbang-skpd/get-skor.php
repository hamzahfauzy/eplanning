<?php 
use yii\helpers\Json;

$res = [];
foreach($data as $key => $val){
	foreach($val as $k => $v){
		if($k == "Rincian_Skor"){
			echo $k.":";
			print_r(unserialize($v));
		}else
			echo $k.":".$v;
		echo "<br>";
	}
}

//print_r($res);
//print_r(Json::encode($res));
?>