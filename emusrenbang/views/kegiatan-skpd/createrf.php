<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */

$this->title = 'Tambah Kegiatan Skpd';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Skpd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-skpd-create">

    <?= $this->render('_formrf', [
        'model' => $model,
        'kp' => $kp,
    ]) ?>

</div>
