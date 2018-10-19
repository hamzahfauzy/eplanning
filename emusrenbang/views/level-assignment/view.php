<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LevelAssignment */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Level Assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-assignment-view">


    <p>
        <?= Html::a('Ubah', ['update', 'username' => $model->username, 'id_level_aplikasi' => $model->id_level_aplikasi, 'id_level_fungsi' => $model->id_level_fungsi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'username' => $model->username, 'id_level_aplikasi' => $model->id_level_aplikasi, 'id_level_fungsi' => $model->id_level_fungsi], [
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
            'id_level_aplikasi',
            'id_level_fungsi',
        ],
    ]) ?>

</div>
