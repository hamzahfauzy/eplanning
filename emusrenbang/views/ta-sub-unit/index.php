<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaSubUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Umum Unit Organisasi';
$this->params['breadcrumbs'][] = "Data Umum";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-sub-unit-index">
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?php 
                    if (Helper::checkRoute('create')) {
                        echo Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success pull-right']);
                    }
                ?>
            </p>
            <h3 class="box-title"><?= $this->title ?></h3>
        </div>
        <div class="box-body">
		<?php
                if(Yii::$app->user->identity->id_level!==1) { ?>
			<table class="table table-striped table-bordered"><colgroup><col>
			<thead>
			<tr>
			<th>No.</th>
			<th><a href="#" data-sort="Tahun">Tahun</a></th>
			<th><a href="#" data-sort="Nm_Pimpinan">Nama  Pimpinan</a></th>
			<th><a href="#" data-sort="Nip_Pimpinan">NIP  Pimpinan</a></th>
			<th><a href="#" data-sort="Jbt_Pimpinan">Jabatan  Pimpinan</a></th>
			<th><a href="#" data-sort="Alamat">Alamat</a></th>
			<th><a href="#" data-sort="Ur_Visi">Visi</a></th>
			<th class="action-column">&nbsp;</th>
			</tr>
			<?php if(count($tes) > 0){ $no=1; foreach($tes as $data){ //print_r();?>
			<tr id="w0-filters" class="filters">
			<td><?php echo $no;$no++; ?></td>
			<td><?php echo $data['Tahun']+1; ?></td>
			<td><?php echo $data['Nm_Pimpinan']; ?></td>
			<td><?php echo $data['Nip_Pimpinan']; ?></td>
			<td><?php echo $data['Jbt_Pimpinan']; ?></td>
			<td><?php echo $data['Alamat']; ?></td>
			<td><?php echo $data['Ur_Visi']; ?></td>
			<td>&nbsp;</td>
			</tr>
			<?php } }else{?>
			</thead>
			<tbody>
			<tr><td colspan="8"><div class="empty">Tidak ada data yang ditemukan.</div></td></tr>
			</tbody>
			<?php } ?>
			</table>
				<?php // echo $this->render('_search', ['model' => $searchModel]); 
			/*
                if(Yii::$app->user->identity->id_level!==1) { ?>

                <table class="table table-hover table-bordered">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No.'
                            ],
                            [
                                'attribute' =>'Tahun',
                                'format' => 'text',
                                'options' => ['class' => 'col-md-1'],
                                'value' => function($model){ return $model->Tahun; }
                            ],
                             'Nm_Pimpinan',
                             'Nip_Pimpinan',
                             'Jbt_Pimpinan',
                             'Alamat',
                             'Ur_Visi',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'options' => ['class' => 'col-md-1']
                            ],
                        ],
                    ]); ?> 
                </table>
                     */
					 
                 } else { ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'Tahun',
                            'Kd_Urusan',
                            'Kd_Bidang',
                            'Kd_Unit',
                            'Kd_Sub',
                             'Nm_Pimpinan',
                             'Nip_Pimpinan',
                             'Jbt_Pimpinan',
                             'Alamat',
                             'Ur_Visi',

                            [
                                'class' => 'yii\grid\ActionColumn', 
                                'template' => Helper::filterActionColumn('{view}{update}{delete}'),
                            ],
                        ],
                    ]); ?>
                <?php }
            ?>
        </div>
    </div>
</div>