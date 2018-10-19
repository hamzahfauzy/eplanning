<?php

use yii\helpers\Html;
use app\models\Referensi;
$ref=new Referensi();


/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

$this->title = 'Tambah Program Rencana Kerja';
$this->params['breadcrumbs'][] = $this->title;

$urusan=Yii::$app->user->identity->id_urusan;
$bidang=Yii::$app->user->identity->id_bidang;

$prog=$ref->getProgramBidangUrusan($urusan, $bidang);

?>
<div class="ref-program-create">


    <?= $this->render('_formprogramskpdwajib', [
        'model' => $model,
        'prog'=>$prog,
        'kdurusan'=>$urusan,
        'kdbidang'=>$bidang,
    ]) ?>

</div>
