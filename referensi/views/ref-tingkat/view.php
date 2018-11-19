<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefTingkat */
?>
<div class="ref-tingkat-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Tingkat',
            'Nm_Tingkat',
        ],
    ]) ?>

</div>
