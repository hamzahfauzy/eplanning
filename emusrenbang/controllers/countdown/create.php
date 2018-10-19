<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Countdown */

$this->title = 'Tambah Jadwal';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countdown-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
