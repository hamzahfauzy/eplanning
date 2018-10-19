<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguUnit */

$this->title = $subunit->Nm_Unit;
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($subunit);
?>
<div class="ta-pagu-unit-view">

    <p>
        <?= Html::a('Ubah', ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit], [
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
			[
				'label'=>'Pagu',
				'value'=> function($model){
					return "Rp. ". number_format($model->pagu,0,',','.');
				}
			]
        ],
    ]) ?>

</div>
