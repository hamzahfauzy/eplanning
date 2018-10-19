<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\FileInput;

?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'template' => '{edit1}{edit2}{edit3}',
                'header' => 'Aksi',
                'buttons' => [
                    'edit1' => function ($url, $model) {
                        return Html::a('Unduh', ['sample-download',
                                    'filename' => realpath(dirname(dirname(dirname(__FILE__)))) . '/web/data/' . $model->kdMedia->Nm_Media], ['class' => 'btn btn-info btn-sm', 'target'=>'_blank', 'data-pjax'=>"0"]);
                        },
                    'edit2' => function ($url, $model) {
                        return Html::Button('Pratinjau', ['class' => 'btn btn-success btn-sm',
                                    'id' => 'preview',
                                    'ext' => $model->kdMedia->Type_Media,
                                    'data' => 'data/' . $model->kdMedia->Nm_Media, //'http://docs.google.com/gview?url=http://writing.engr.psu.edu/workbooks/formal_report_template.doc&embedded=true',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal_preview']);
                        },
                    'edit3' => function ($url, $model){
                        return Html::a('Hapus', ['ta-musrenbang-kecamatan-media/hapus-berkas', 'id' => $model->Kd_Media],['class' => 'btn btn-danger btn-sm']);
                        },
                        ],
                    ],
                ],
            ]);
    ?>
<?php Pjax::end(); ?>

  