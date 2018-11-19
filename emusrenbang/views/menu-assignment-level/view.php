<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignmentLevel */

$this->title = $model->level;
$this->params['breadcrumbs'][] = ['label' => 'Menu Assignment Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-assignment-level-view">


    <p>
        <?= Html::a('Update', ['update', 'level' => $model->level, 'id_menu' => $model->id_menu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'level' => $model->level, 'id_menu' => $model->id_menu], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'level',
            'id_menu',
        ],
    ]) ?>

</div>
