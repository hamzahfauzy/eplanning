<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianKegiatan */

$this->title = 'Tambah Penilaian Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-kegiatan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
