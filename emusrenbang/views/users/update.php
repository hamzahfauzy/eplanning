<?php

use yii\helpers\Html;
use app\models\Referensi;
$ref=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Rubah User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
$bidang=$ref->getBidangUrusan($model->id_urusan);
$dataSkpd=$ref->getUnitBidangUrusan($model->id_urusan, $model->id_bidang);
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'bidang' => $bidang,
        'dataSkpd'=>$dataSkpd,
    ]) ?>

</div>
