<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PrioritasNasional */

$this->title = 'Tambah Prioritas Nasional';
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Prioritas Nasional', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="prioritas-nasional-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
