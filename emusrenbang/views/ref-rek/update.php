<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRek3 */

$this->title = 'Ubah Ref Rek3: ' . $model->Kd_Rek_1;
$this->params['breadcrumbs'][] = ['label' => 'Ref Rek3s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Rek_1, 'url' => ['view', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-rek3-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
