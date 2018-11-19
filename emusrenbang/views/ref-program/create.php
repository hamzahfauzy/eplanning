<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

$this->title = 'Tambah Program Pilihan';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Program Pilihan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-create">


    <?= $this->render('_formprogram', [
        'model' => $model,
    ]) ?>

</div>
