<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UraianKegiatan */

$this->title = 'Create Uraian Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Uraian Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uraian-kegiatan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
