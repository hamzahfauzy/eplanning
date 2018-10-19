<?php

namespace satuanharga\controllers;

use Yii;

class DashboardController extends \yii\web\Controller {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'main-front';
        }
        return $this->render('index');
    }

}
