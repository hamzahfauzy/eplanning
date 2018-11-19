<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProgramNasional */

$this->title = 'Tambah Program Nasional';
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Program Nasional', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-nasional-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
