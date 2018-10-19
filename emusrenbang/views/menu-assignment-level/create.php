<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignmentLevel */

$this->title = 'Tambah Menu Assignment Level';
$this->params['breadcrumbs'][] = ['label' => 'Menu Assignment Level', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-assignment-level-create">


    <?= $this->render('_form', [
        'model' => $model,
        'level' => $level,
        'menus' => $menus,
    ]) ?>

</div>
