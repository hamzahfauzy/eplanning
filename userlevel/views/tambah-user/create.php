<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = 'Tambah User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'kec' => $kec,
        'jenis_user' => $jenis_user,
        'level' => $level,
        'dataSkpd' => $dataSkpd,
        'dapil' => $dapil,
        'fraksi' => $fraksi,
        'komisi' => $komisi,
    ]) ?>

</div>
