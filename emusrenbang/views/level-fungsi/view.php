<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LevelFungsi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Level Fungsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-fungsi-view">


    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
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
            'id',
            'fungsi',
        ],
    ]) ?>

</div>
