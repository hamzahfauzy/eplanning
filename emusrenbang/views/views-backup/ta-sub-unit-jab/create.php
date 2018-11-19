<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnitJab */

$this->title = 'Tambah Data Jabatan Unit Organisasi';
$this->params['breadcrumbs'][] = ['label' => 'Data Jabatan Unit Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-jab-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
