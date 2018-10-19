<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LevelAssignment */

$this->title = 'Ubah Level Assignment: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Level Assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'username' => $model->username, 'id_level_aplikasi' => $model->id_level_aplikasi, 'id_level_fungsi' => $model->id_level_fungsi]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="level-assignment-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
