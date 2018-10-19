<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= 
    	GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'username',
                'ip',
                'kegiatan',
                // 'created_at',
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'filter' => \yii\jui\DatePicker::widget([
                        'model'=>$searchModel,
                        'attribute'=>'created_at',
                        'language' => 'en',
                        'dateFormat' => 'yyyy-MM-dd',
                    ]),
                    'format' => 'html',
                ],
    		],
    	]); 
    ?>
    <?php Pjax::end(); ?>
</div>
