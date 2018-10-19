<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKamusProgram */

$this->title = 'Tambah Referensi Kamus Program';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Kamus Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kamus-program-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
