<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaMusrenbangKelurahanMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Edit Berkas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="kelurahan-upload">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>
       
    
        <div class="form-group">
			<?= Html::submitButton('Selesai', ['class' => 'btn btn-primary', 'name' => 'selesai']) ?>
            <?= Html::submitButton('Tambah', ['class' => 'btn btn-primary', 'name' => 'tambah']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'Volume',
			 'format' => 'raw',
			 'value' => function($model, $key, $index)
			{   
                return Html::a($model->kdMedia->Judul_Media.'.'.$model->kdMedia->Type_Media, ['sample-download',
				'filename' => realpath(dirname(dirname(dirname(__FILE__)))).'\\web\\data\\'.$model->kdMedia->Nm_Media],
				['class'=>'btn btn-info btn-sm']);;
				
            },
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
