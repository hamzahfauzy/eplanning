<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Programs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programs-view">



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
            'id_prioritas',
            'nama_program',
            'indikator_program',
            'status',
            'aktif',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
