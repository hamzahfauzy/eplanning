<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHonor */
?>
<div class="ref-honor-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Honor',
            'Nm_Honor:ntext',
        ],
    ]) ?>

</div>
