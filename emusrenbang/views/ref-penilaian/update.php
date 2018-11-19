<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaian */

$this->title = 'Update Referensi Penilaian: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Referensi Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-penilaian-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
