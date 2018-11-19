<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKelurahan */
?>
<div class="ref-kelurahan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            'Kd_Kel',
            'Kd_Urut',
            'Nm_Kel',
        ],
    ]) ?>

</div>
