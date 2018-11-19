<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaProfile */

$this->title = $model->Kd_User;
$this->params['breadcrumbs'][] = ['label' => 'Ta Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-profile-view">

    <p>
        <?= Html::a('Update', ['create', 'id' => $model->Kd_User], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Kd_User], [
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
            'Nm_Lengkap',
            'Tgl_Lahir',
            'Alamat',
            'Telp',
            'Mobile',
            'Foto',
            'NIP',
        ],
    ]) ?>

</div>
