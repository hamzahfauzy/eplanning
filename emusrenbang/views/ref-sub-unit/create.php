<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubUnit */

$this->title = 'Tambah UPT';
$this->params['breadcrumbs'][] = "Unit Organisasi";
$this->params['breadcrumbs'][] = ['label' => 'UPT', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
