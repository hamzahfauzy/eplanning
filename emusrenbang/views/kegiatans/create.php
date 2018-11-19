<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kegiatans */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatans-create">


    <?= $this->render('_form', [
        'model' => $model,
        'dataProgram' => $dataProgram,
    ]) ?>

</div>
