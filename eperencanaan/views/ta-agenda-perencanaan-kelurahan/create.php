<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaAgendaPerencanaanKelurahan */

$this->title = 'Create Ta Agenda Perencanaan Kelurahan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Agenda Perencanaan Kelurahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-agenda-perencanaan-kelurahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
