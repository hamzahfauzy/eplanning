<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaKegiatanApbn */

$this->title = 'Create Ta Kegiatan Apbn';
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatan Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-apbn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
