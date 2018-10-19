<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnit */

$this->title = 'Tambah Data Umum Unit Organisasi';
$this->params['breadcrumbs'][] = "Data Umum";
$this->params['breadcrumbs'][] = ['label' => 'Data Umum Unit Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah Data";
$bidang=array();
?>
<div class="ta-sub-unit-create">
    <?= $this->render('_form', [
        'model' => $model,
        'bidang'=> $bidang,
    ]) ?>

</div>
