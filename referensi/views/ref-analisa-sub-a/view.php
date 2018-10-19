<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAnalisaSubA */
?>
<div class="ref-analisa-sub-a-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Analisa',
            'Kd_Analisa_Sub',
            'Kd_Analisa_Sub_A',
            'Nm_Analisa_Sub_A',
        ],
    ]) ?>

</div>
