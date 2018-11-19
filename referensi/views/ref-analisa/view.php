<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAnalisa */
?>
<div class="ref-analisa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Analisa',
            'Nm_Analisa',
        ],
    ]) ?>

</div>
