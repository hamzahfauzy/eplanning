<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->Nm_Lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Lengkap, 'url' => ['view', 'id' => $model->Kd_User]];
$this->params['breadcrumbs'][] = 'Update';
?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

