<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefApPubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Ap Pubs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
                <?php
                if (Helper::checkRoute('create')) {
                    echo Html::a('Tambah AP Publik', ['create'], ['class' => 'btn btn-success pull-right']);
                }
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'Kd_Ap_Pub',
                        'Nm_Ap_Pub',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>            
    </div>
</div>
