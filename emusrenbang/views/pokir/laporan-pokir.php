<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->title = 'Laporan Pokir';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">
        	<table class="table table-hover">

	        <?= 
	            GridView::widget([
	            'dataProvider' => $dataProvider,
	            'filterModel' => $searchModel,
	            'columns' => [
		            [
			            'attribute' => 'Nm_Permasalahan',
			            'label' => 'Kegiatan Prioritas'
			        ],
		            [
			            'attribute' => 'Jenis_Usulan',
			            'label' => 'Prioritas Daerah'
			        ],
		            [
			            'attribute' => 'Jumlah',
			            'label' => 'Jumlah/Vol'
			        ],
		            [
			            'attribute' => 'Harga_Total',
			            'label' => 'Pagu(Rp)',
			            'value' => function ($model) { return number_format("".$model->Harga_Satuan, "2", ",", ".");}
			        ],
		            [
			            'attribute' => 'Kd_Pem',
			            'label' => 'OPD Penganggung Jawab',
			            'value' => function ($model) { return $model->subUnit->kdSubUnit->Nm_Sub_Unit; }
			        ],
		            [
			            'attribute' => 'Kd_Pem',
			            'label' => 'Kd Pembangunan'
			        ],
	            ],
	            ]); 
	        ?>
	        </table>
        </div>
      </div>
    </div>
  </div>
</div>