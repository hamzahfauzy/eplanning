<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data User';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="row">
        <div class="col-md-12">
            <div class="user-index box box-danger">

                <h1><?php // Html::encode($this->title) ?></h1>
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <div class="box-header">
                    <p>
                        <?= Html::a('Tambah User', ['create'], ['class' => 'btn btn-danger']) ?>
                    </p>
                </div>

                <div class="box-body">               
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'username',
                            //'auth_key',
                            //'password_hash',
                            //'password_reset_token',
                             'email:email',
                            // 'status',
                            [
                                'attribute' => 'created_at',
                                'format' => ['DateTime','php:d-m-Y H:i:s'],
                            ],
                            // 'updated_at',
                            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{edit1} {edit2} {edit3} {edit4} {edit5}',
                            
                            'buttons' => [
                                'edit1' => function ($url, $model){
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>&nbsp',['view', 'id' => $model->id]);
                                },
                                 'edit2' => function ($url, $model){
                                  return Html::a(' <span class="glyphicon glyphicon-pencil"> </span>&nbsp',['update', 'id' => $model->id]);
                                 },
                                'edit3' => function ($url, $model){
                                    return Html::a(' <span class="glyphicon glyphicon-user"> </span>&nbsp',['/ta-profile/create', 'id' => $model->id]);
                                },
                                // 'edit4' => function ($url, $model){
                                //     return Html::a(' <span class="glyphicon glyphicon-fire"> </span>&nbsp',['/ta-user-aplikasi/index', 'id' => $model->id]);
                                // },
                                'edit5' => function ($url, $model){
                                    return Html::a(' <span class="glyphicon glyphicon-trash"> </span>&nbsp',['/tambah-user/delete', 'id' => $model->id],
                                    ['data' => [
                                        'confirm' => "Anda yakin akan menghapus data ini?",
                                        'method' => 'post',
                                        ],
                                    ]);
                                }
                                ],
                            ],
                        ],
                        
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>