<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Helper::checkRoute('create')){ ?>
    <p>
        <?= Html::a('Tambah User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'created_at:date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 0 ? 'Inactive' : 'Active';
                },
                'filter' => [
                    0 => 'Inactive',
                    10 => 'Active'
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn(['activate','view', 'update', 'delete']),
                'buttons' => [
                    'activate' => function($url, $model) {
                        if ($model->status == 10) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('rbac-admin', 'Activate'),
                            'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                    },
					'inactivate' => function($url, $model) {
                        if ($model->status == 0) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('rbac-admin', 'Inactivate'),
                            'aria-label' => Yii::t('rbac-admin', 'Inactivate'),
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to inactivate this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, $options);
                    },
                    'delete' => function($url,$model) {
                        if ($model->id == Yii::$app->user->identity->id) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('rbac-admin', 'Delete'),
                            'aria-label' => Yii::t('rbac-admin', 'Delete'),
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to delete this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    }
                ]
                ],
            ],
        ]);
        ?>
</div>