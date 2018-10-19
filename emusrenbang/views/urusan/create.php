<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Urusan */

$this->title = 'Tambah Urusan Provinsi';
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Urusan Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urusan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
