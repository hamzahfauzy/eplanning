<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignment */

$this->title = 'Tambah Menu Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Menu Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'menus' => $menus,
    ]) ?>

</div>
