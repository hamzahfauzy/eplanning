<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaForumLingkungan */

$this->title = $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Forum Lingkungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-forum-lingkungan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Tahun',
            //'Kd_Benua',
            //'Kd_Benua_Sub',
            //'Kd_Benua_Sub_Negara',
            'kdProv.Nm_Prov',
			'kdKab.Nm_Kab',
			'kdKec.Nm_Kec',
			'kdKel.Nm_Kel',
			'kdLink.Nm_Lingkungan',
			
            //'Kd_Kab',
            //'Kd_Kec',
            //'Kd_Kel',
            //'Kd_Urut_Kel',
            //'Kd_Lingkungan',
            //'Kd_Jalan',
            //'Kd_Usulan',
            //'Kd_Klasifikasi',
            'Nm_Permasalahan',
            'Volume',
            'kdSatuan.Uraian',
            //'Kd_Sasaran',
        ],
    ]) ?>

</div>
