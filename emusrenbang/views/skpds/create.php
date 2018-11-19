<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Skpds */

$this->title = 'Tambah Skpd';
$this->params['breadcrumbs'][] = ['label' => 'Skpd', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skpds-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
