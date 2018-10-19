<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHonorSub */
?>
<div class="ref-honor-sub-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Honor',
            'Kd_Honor_Sub',
            'Nm_Honor_Sub:ntext',
        ],
    ]) ?>

</div>
