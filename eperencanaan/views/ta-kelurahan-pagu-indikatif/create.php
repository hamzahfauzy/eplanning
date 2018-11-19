<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKelurahanPaguIndikatif */

$this->title = 'Tambah Pagu Indikatif Kelurahan';
$this->params['breadcrumbs'][] = ['label' => 'Pagu Indikatif Kelurahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kelurahan-pagu-indikatif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
