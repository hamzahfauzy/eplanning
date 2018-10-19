<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaUserAplikasi */

$this->title = 'Update Ta User Aplikasi: ' . $model->Kd_User;
$this->params['breadcrumbs'][] = ['label' => 'Ta User Aplikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_User, 'url' => ['view', 'Kd_User' => $model->Kd_User, 'Kd_Aplikasi' => $model->Kd_Aplikasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-user-aplikasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
