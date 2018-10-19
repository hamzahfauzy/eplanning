<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaLingkunganPaguIndikatif */

$this->title = 'Tambah Pagu Indikatif Lingkungan';
$this->params['breadcrumbs'][] = ['label' => 'Pagu Indikatif Lingkungan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-lingkungan-pagu-indikatif-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
