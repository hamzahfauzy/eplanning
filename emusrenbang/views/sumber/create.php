<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sumber */

$this->title = 'Tambah Sumber';
$this->params['breadcrumbs'][] = ['label' => 'Sumber', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sumber-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
