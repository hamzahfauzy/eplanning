<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefApPub */

$this->title = 'Update Ref Ap Pub: ' . $model->Kd_Ap_Pub;
$this->params['breadcrumbs'][] = ['label' => 'Ref Ap Pubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Ap_Pub, 'url' => ['view', 'id' => $model->Kd_Ap_Pub]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-ap-pub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
