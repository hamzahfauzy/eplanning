<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBidang */

$this->title = 'Tambah Bidang';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Data Sektor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bidang-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
