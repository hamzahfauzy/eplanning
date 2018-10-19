<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefEditdata */
?>
<div class="ref-editdata-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Edit',
            'Nm_Edit',
        ],
    ]) ?>

</div>
