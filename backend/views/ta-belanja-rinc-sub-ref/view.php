<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaBelanjaRincSubRef */
?>
<div class="ta-belanja-rinc-sub-ref-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Prog',
            'ID_Prog',
            'Kd_Keg',
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
            'No_Rinc',
            'No_ID',
            'Ref_Harga',
            'Keterangan',
        ],
    ]) ?>

</div>
