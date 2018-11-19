<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaFungsi */

$this->title = 'Tambah Fungsi';
$this->params['breadcrumbs'][] = ['label' => 'Fungsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-fungsi-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
