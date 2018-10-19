<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LevelFungsi */

$this->title = 'Ubah Level Fungsi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Level Fungsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="level-fungsi-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
