<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUrusan */

$this->title = 'Tambah Urusan';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Urusan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-urusan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
