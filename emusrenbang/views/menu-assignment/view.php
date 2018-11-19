<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAssignment */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Menu Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-assignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'username' => $model->username, 'id_menu' => $model->id_menu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'username' => $model->username, 'id_menu' => $model->id_menu], [
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
            'username',
            'id_menu',
        ],
    ]) ?>

</div>
