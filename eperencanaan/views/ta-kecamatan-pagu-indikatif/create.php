<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKecamatanPaguIndikatif */

$this->title = 'Tambah Pagu Indikatif Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Pagu Indikatif Kecamatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kecamatan-pagu-indikatif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
