<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaUserAplikasi */

$this->title = $model->Kd_User;
$this->params['breadcrumbs'][] = ['label' => 'Ta User Aplikasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-user-aplikasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Kd_User' => $model->Kd_User, 'Kd_Aplikasi' => $model->Kd_Aplikasi], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Kd_User' => $model->Kd_User, 'Kd_Aplikasi' => $model->Kd_Aplikasi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_User',
            'Kd_Aplikasi',
        ],
    ]) ?>

</div>
