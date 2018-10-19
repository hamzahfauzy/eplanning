<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAnalisaSub */
?>
<div class="ref-analisa-sub-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Analisa',
            'Kd_Analisa_Sub',
            'Nm_Analisa_Sub',
        ],
    ]) ?>

</div>
