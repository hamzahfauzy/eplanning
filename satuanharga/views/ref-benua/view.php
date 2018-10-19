<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefBenua */
?>
<div class="ref-benua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Benua',
            'Nm_Benua',
        ],
    ]) ?>

</div>
