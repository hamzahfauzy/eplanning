<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefFungsi */

$this->title = 'Tambah Data Fungsi';
$this->params['breadcrumbs'][] = ['label' => 'Data Fungsis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-fungsi-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
