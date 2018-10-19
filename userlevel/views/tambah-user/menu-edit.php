<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
             'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',
		
            ['class' => 'yii\grid\ActionColumn',
			'template' => '{edit1} {edit2} {edit3} {edit4} {edit5}',
			
			'buttons' => [
				'edit1' => function ($url, $model){
					return Html::a('Edit Username',['isi-asal', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
				},
				'edit2' => function ($url, $model){
					//Yii::$app->session->addFlash('info', 'edit');
					return Html::a('Edit Asal',['isi-asal', 'id' => $model->id, 'status' => 'edit', 'ZULmodel' => $model], ['class' => 'btn btn-primary btn-sm']);
				},
				'edit3' => function ($url, $model){
					return Html::a('Edit Unit',['/ta-profile/create', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
				},
				
				],
			],
        ],
		
    ]); ?>
    <?php Pjax::end(); ?>
</div>
