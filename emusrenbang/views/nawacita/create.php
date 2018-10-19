<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = 'Tambah Nawacita';
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Nawacita', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="nawacita-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
