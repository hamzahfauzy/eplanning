<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\bootstrap\Modal;

$this->title = 'Dokumen Usulan Pokir';

$this->registerJsFile(
    '@web/js/dokumen_usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/musrenbang.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="box-header">
</div>
<div class="box-header with-border">
	<?= GridView::widget([
	    'dataProvider' => $dataProvider,
	    'columns' => [
	        ['class' => 'yii\grid\SerialColumn'],
	        ['attribute' => 'Nama Berkas',
	            'format' => 'raw',
	            'value' => function($model, $key, $index) {
	                return '<h5>' . $model->kdMedia->Judul_Media . '.' . $model->kdMedia->Type_Media . '</h5>';
	            },
	        ],
	        ['attribute' => 'Kategori',
	            'format' => 'raw',
	            'value' => function($model, $key, $index) {
	                return '<p>' . $model->Jenis_Dokumen . '</p>';
	            },
	        ],
	        ['class' => 'yii\grid\ActionColumn',
	            'template' => '{edit1}{edit2}',
	            'header' => 'Aksi',
	            'buttons' => [
	                'edit1' => function ($url, $model) {
	                    return Html::a('Unduh', ['sample-download',
	                                'filename' => '../../eperencanaan/web/data/' . $model->kdMedia->Nm_Media], ['target' => '_blank', 'class' => 'btn btn-info btn-sm']);
	                    },
	                'edit2' => function ($url, $model) {
	                    return Html::Button('Pratinjau', ['class' => 'btn btn-success btn-sm lihat_file',
	                                'data-url' => "index.php?r=ta-musrenbang/lihat-file&nama_file=".$model->kdMedia->Nm_Media,
	                                ]);
	                    },
	                // 'edit3' => function ($url, $model){
	                //     return Html::a('Hapus', ['ta-musrenbang-kecamatan-media/hapus-berkas', 'id' => $model->Kd_Media],['class' => 'btn btn-danger btn-sm']);
	                //     },
	                    ],
	                ],
	            ],
	        ]);
	?>
</div>
<?php
Modal::begin([
    'header' => '<h4>Lihat File</h4>',
    "size"=>"modal-default",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatFileModal",
]);
echo "<div id='isi_modal'></div>";
Modal::end();
?>