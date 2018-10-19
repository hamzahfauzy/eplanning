<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Tambah User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$bidang=array();
$dataSkpd=array();
?>
<div class="user-create">


    <?= $this->render('_form', [
        'model' => $model,
        'bidang' => $bidang,
        'dataSkpd'=>$dataSkpd,
    ]) ?>

</div>
