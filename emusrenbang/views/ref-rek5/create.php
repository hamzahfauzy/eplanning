<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRek5 */

$this->title = 'Tambah Referensi Rekening Rincian Objek';
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Rincian Objek', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="ref-rek5-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
