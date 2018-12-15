<?php

namespace emonev\models;

use yii\base\Model;
use Yii;
use common\models\Log;

class Savelog extends Model
{
	public function save($pesan, $kegiatan, $tabel, $id_tabel){ //pesan, kegiatan, tabel, id dari tabel
		$model=new Log();
		$model->Kd_User = Yii::$app->user->identity->id;
		$model->username=\Yii::$app->user->identity->username;
		$model->ip=$userIP = Yii::$app->request->userIP;	
		// $model->controller = $controller;
		$model->controller = Yii::$app->controller->id;
		// $model->action = $action;
		$model->action = Yii::$app->controller->action->id;
		$model->pesan = $pesan;
		$model->kegiatan = $kegiatan;
		$model->tabel = $tabel;
		$model->id_tabel = $id_tabel;
		$model->save();
	}	
}