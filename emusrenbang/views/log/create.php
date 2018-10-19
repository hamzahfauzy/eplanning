<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Log */

$this->title = 'Tambah Log';
$this->params['breadcrumbs'][] = ['label' => 'Log', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
