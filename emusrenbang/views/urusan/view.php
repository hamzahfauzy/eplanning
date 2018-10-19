<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Urusan */

$this->title = $model->urusan;
$this->params['breadcrumbs'][] = "Nasional/Provinsi";
$this->params['breadcrumbs'][] = ['label' => 'Urusan Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urusan-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Urusan</h3>

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
                'idMisi',
                'urusan:ntext',
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
