<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LokasiKegiatan */

$this->title = 'Tambah Lokasi Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Lokasi Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lokasi-kegiatan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
