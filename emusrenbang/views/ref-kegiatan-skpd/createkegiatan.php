<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatan */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['kegiatan-skpd/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kegiatan-create">


    <?= $this->render('_formkegiatan', [
        'model' => $model,
    ]) ?>

</div>
