<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignment */

$this->title = 'Update Menu Assignment: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Menu Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'username' => $model->username, 'id_menu' => $model->id_menu]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="menu-assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'menus' => $menus,
    ]) ?>

</div>
