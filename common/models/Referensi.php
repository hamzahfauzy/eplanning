<?php
namespace common\models;
use Yii;
use yii\base\Model;
use common\models\RefLevel;

class Referensi extends Model
{
	public function getLevelName($id){
		$level = RefLevel::findOne($id);
		return $level->Nm_Level;
	}
	
}