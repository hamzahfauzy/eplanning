<?php

namespace eperencanaan\controllers;

class SkpdEksplorerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionKecamatan()
    {
        return $this->render('kecamatan');
    }

    public function actionKelurahan()
    {
        return $this->render('kelurahan');
    }

    public function actionLingkungan()
    {
        return $this->render('lingkungan');
    }

    public function actionPokir()
    {
        return $this->render('pokir');
    }

}
