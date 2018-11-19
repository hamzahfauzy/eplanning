<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJabatan */

$this->title = 'Tambah Ref Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jabatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
