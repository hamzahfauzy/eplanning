<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaKalender */

$this->title = 'Update Ta Kalender: ' . $model->Kd_Kalender;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kalenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Kalender, 'url' => ['view', 'id' => $model->Kd_Kalender]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-kalender-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
