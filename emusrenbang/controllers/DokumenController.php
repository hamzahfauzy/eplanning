<?php

namespace emusrenbang\controllers;

class DokumenController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new \eperencanaan\models\UploadForm();
        return $this->render('index', ['model' => $model]);
    }

}
