<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguProgram */

$this->title = $subunit->Nm_Unit;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pagu-program-view">

    <h1><?=$program->Ket_Program;?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog], [
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
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Prog',
            [
				'label'=>'Pagu',
				'value'=> function($model){
					return "Rp. ". number_format($model->pagu,0,',','.');
				}
			]
        ],
    ]) ?>

</div>
