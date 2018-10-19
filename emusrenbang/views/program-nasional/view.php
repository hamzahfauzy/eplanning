<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProgramNasional */

$this->title = $model->tahun;
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Program Nasional', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-nasional-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_prioritas',
            'id_nawacita',
            'id_urusan',
            'id_misi',
            'urusan',
            'bidang',
            'id_program',
            'created_at',
            'updated_at',
            'username',
        ],
    ]) ?>

</div>
