<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetailProgram */

$this->title = 'Tambah Detail Program';
$this->params['breadcrumbs'][] = ['label' => 'Detail Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-program-create">

    <?= $this->render('_form', [
        'model' => $model,
        'kode_program' => $kode_program,
    ]) ?>

</div>
