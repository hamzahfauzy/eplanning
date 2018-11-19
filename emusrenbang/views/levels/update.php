<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Levels */

$this->title = 'Ubah Level: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Level', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="levels-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
