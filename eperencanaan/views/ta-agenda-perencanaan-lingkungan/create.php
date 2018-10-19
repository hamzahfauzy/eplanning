<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaAgendaPerencanaanLingkungan */

$this->title = 'Create Ta Agenda Perencanaan Lingkungan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Agenda Perencanaan Lingkungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-agenda-perencanaan-lingkungan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
