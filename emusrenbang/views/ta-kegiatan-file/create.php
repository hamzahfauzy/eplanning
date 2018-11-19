<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatanFile */

$this->title = 'Create Ta Kegiatan File';
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatan Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
