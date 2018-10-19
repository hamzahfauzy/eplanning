<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaRpjmdPrioritasPembangunanDaerahSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prioritas Pembangunan Daerah';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
if (Helper::checkRoute('create')) {
    $create = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Tambah Prioritas Pembangunan Daerah','class'=>'btn btn-default']);
}
else{
    $create='';
}

?>
<div class="ta-rpjmd-prioritas-pembangunan-daerah-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    $create.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Daftar']).
                    '{toggleData}'.
                    '{export}'
                ],
            ], 
            'options' =>[
                'class' => 'table table-bordered',
            ],            
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Daftar Prioritas Pembangunan Daerah',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
