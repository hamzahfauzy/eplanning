<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Halaman Statis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h1 class="box-title"><?= Html::encode($this->title) ?></h1>

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
                'title',
                'content:ntext',
                'title_seo',
                'create_at',
                'update_at',
                'publish_at',
                'username',
                'view',
                'hit',
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
