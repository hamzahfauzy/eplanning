<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignmentLevel */

$this->title = 'Update Menu Assignment Level: ' . $model->level;
$this->params['breadcrumbs'][] = ['label' => 'Menu Assignment Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->level, 'url' => ['view', 'level' => $model->level, 'id_menu' => $model->id_menu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-assignment-level-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
