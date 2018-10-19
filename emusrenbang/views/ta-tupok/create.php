<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaTupok */

$this->title = 'Tambah Tugas Pokok';
$this->params['breadcrumbs'][] = ['label' => 'Tugas Pokok', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tupok-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
