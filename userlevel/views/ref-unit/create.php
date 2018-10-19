<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUnit */

$this->title = 'Tambah OPD';
$this->params['breadcrumbs'][] = "Unit Organisasi";
$this->params['breadcrumbs'][] = ['label' => 'OPD', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="ref-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
