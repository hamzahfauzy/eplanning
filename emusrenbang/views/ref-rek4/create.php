<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRek4 */

$this->title = 'Tambah Referensi Rekening Objek';
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Objek', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="ref-rek4-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
