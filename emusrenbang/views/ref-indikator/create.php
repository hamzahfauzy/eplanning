<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefIndikator */

$this->title = 'Tambah Ref Indikator';
$this->params['breadcrumbs'][] = ['label' => 'Ref Indikators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-indikator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
