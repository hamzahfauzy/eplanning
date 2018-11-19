<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaUraianKegiatan */

$this->title = 'Tambah Ta Uraian Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Uraian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-uraian-kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
