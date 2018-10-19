<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHonorSubA */
?>
<div class="ref-honor-sub-a-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Honor',
            'Kd_Honor_Sub',
            'Kd_Honor_Sub_A',
            'Nm_Honor_Sub_A',
        ],
    ]) ?>

</div>
