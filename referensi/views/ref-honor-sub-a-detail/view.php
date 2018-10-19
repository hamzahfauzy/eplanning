<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHonorSubADetail */
?>
<div class="ref-honor-sub-adetail-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Honor',
            'Kd_Honor_Sub',
            'Kd_Honor_Sub_A',
            'Kd_Honor_Sub_A_Detail',
            'Nm_Honor_Sub_A_Detail',
        ],
    ]) ?>

</div>
