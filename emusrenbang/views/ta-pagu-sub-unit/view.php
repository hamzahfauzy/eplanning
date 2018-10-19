<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaPaguSubUnit */

$this->title = @$subunit->Nm_Sub_Unit;
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Sub Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pagu-sub-unit-view">

    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

          <div class="box-tools pull-right">

            <p>
                <?= Html::a("<i class=\"fa fa-edit\"></i> Ubah", ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub], [
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'tooltip',
                    'title' => 'Ubah',
                ]) ?>
                <?= Html::a("<i class=\"fa fa-trash\"></i> Hapus", ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub], [
                    'class' => 'btn btn-danger',
                    'data-toggle' => 'tooltip',
                    'title' => 'Hapus',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

          </div>
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'Tahun',
                'Kd_Urusan',
                'Kd_Bidang',
                'Kd_Unit',
                'Kd_Sub',
                [
					'label'=>'Pagu',
					'value'=> function($model){
						return "Rp. ". number_format($model->pagu,0,',','.');
					}
				]
            ],
        ]) ?>
    </div>

</div>
