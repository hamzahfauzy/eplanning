<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefLevel */
?>
<div class="ref-level-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Level',
            'Nm_Level',
        ],
    ]) ?>

</div>
