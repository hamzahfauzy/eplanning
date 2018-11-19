<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DetailProgram */

$this->title = $model->kode_program;
$this->params['breadcrumbs'][] = ['label' => 'Detail Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-program-view">

    <p>
        <?php //Html::a('Update', ['update', 'id' => $model->kode_program], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->kode_program], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_program',
            'tahun',
            'lokasi',
            'target',
            'pagu',
            'sumber',
            'catatan',
            'prakiraan_target',
            'prakiraan_pagu',
        ],
    ]) ?>

</div>
