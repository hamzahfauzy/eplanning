<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pantau Kunjung';
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

                'id',
                'username',
                'email:email',
    		
                ['class' => 'yii\grid\ActionColumn',
    							'template' => '{edit1}',
    							'buttons' => [
    								'edit1' => function ($url, $model){
                                        $Kd_User = $model->id;
                                        $btn = Html::a('Detail', ['log-user/detail', 'user_id' => $Kd_User], ['class' => 'btn btn-primary']);
    									return $btn;
    								},
    							],
    	        ],
    		],
    	]); 
    ?>
    <?php Pjax::end(); ?>
</div>
