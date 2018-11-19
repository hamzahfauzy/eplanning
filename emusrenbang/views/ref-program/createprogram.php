<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

$this->title = 'Tambah Program';
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-create">

    <?= $this->render('_form', [
        'model' => $model,
        'kp' => $kp,
    ]) ?>

</div>
