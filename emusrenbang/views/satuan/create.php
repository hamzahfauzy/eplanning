<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Satuan */

$this->title = 'Tambah Satuan';
$this->params['breadcrumbs'][] = ['label' => 'Satuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
