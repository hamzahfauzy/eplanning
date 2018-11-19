<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefSumberDana */
?>
<div class="ref-sumber-dana-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Sumber',
            'Nm_Sumber',
        ],
    ]) ?>

</div>
