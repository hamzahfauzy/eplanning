<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb */
?>
<div class="ref-asb-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdAsb1.kdAsb1.kdAsb1.kdAsb1.Nm_Asb1',
            'kdAsb1.kdAsb1.kdAsb1.Nm_Asb2',
            'kdAsb1.kdAsb1.Nm_Asb3',
            'kdAsb1.Nm_Asb4',
            'Kd_Asb5',
            'Jenis_Pekerjaan',
            'Kd_Satuan',
            'Harga',
        ],
    ]) ?>

</div>
