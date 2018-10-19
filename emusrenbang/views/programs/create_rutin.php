<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Programs */

$this->title = 'Tambah Program Rutin';
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programs-create">



    <?= $this->render('_form_rutin', [
        'model' => $model,
    ]) ?>

</div>
