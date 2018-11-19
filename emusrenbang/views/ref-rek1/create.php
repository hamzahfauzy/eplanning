<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRek1 */

$this->title = 'Tambah Referensi Rekening Akun';
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Akun', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="ref-rek1-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
