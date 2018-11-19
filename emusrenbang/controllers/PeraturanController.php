<?php

namespace emusrenbang\controllers;
use Yii;
use common\models\RefSubUnit;

class PeraturanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRkpd()
    {
    	$RefSubUnit = RefSubUnit::find()->where(['!=', 'Nm_Sub_Unit', ''])->orderBy('Nm_Sub_Unit')->all();
      return $this->render('rkpd',[
        'RefSubUnit' => $RefSubUnit
      ]);
    }

}
