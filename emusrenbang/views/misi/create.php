<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Tambah Visi Misi Provinsi';
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Visi Misi Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="misi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
