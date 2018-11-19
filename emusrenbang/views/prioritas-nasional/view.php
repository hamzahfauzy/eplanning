<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PrioritasNasional */

$this->title = "Prioritas Nasional";
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Prioritas Nasional', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prioritas-nasional-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-9"><h3 class="box-title"><?=$model->prioritas_nasional?></h3></div>

          <div class="box-tools pull-right">
            
            <p>
                <?= Html::a("<i class=\"fa fa-edit\"></i> Ubah", ['update', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'tooltip',
                    'title' => 'Ubah',
                ]) ?>
                <?= Html::a("<i class=\"fa fa-trash\"></i> Hapus", ['delete', 'id' => $model->id], [
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
                'id',
                'id_nawacita',
                'prioritas_nasional',
                'tahun',
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
