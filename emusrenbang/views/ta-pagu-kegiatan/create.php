<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaPaguKegiatan */

$this->title = 'Tambah Ta Pagu Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pagu-kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
