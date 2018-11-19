<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaPenilaianKegiatan */

$this->title = 'Create Ta Penilaian Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Penilaian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-penilaian-kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
