<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Tambah Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatans-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
