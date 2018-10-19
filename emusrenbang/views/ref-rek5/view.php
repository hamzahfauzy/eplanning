<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefRek5 */

$this->title = $model->Nm_Rek_5;
$this->params['breadcrumbs'][] = "Referensi Rekening";
$this->params['breadcrumbs'][] = ['label' => 'Data Rincian Objek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rek5-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Rincian Objek</h3>

          <div class="box-tools pull-right">
            
            <p>
                <?= Html::a("<i class=\"fa fa-edit\"></i> Ubah", ['update', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3, 'Kd_Rek_4' => $model->Kd_Rek_4, 'Kd_Rek_5' => $model->Kd_Rek_5], [
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'tooltip',
                    'title' => 'Ubah',
                ]) ?>
                <?= Html::a("<i class=\"fa fa-trash\"></i> Hapus", ['delete', 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3, 'Kd_Rek_4' => $model->Kd_Rek_4, 'Kd_Rek_5' => $model->Kd_Rek_5], [
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
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'Kd_Rek_1',
                'Kd_Rek_2',
                'Kd_Rek_3',
                'Kd_Rek_4',
                'Kd_Rek_5',
                'Nm_Rek_5',
                'Peraturan',
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
