<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRek2 */

$this->title = 'Tambah Referensi Rekening Kelompok';
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Kelompok', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="ref-rek2-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
