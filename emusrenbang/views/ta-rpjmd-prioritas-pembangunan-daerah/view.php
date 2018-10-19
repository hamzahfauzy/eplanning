<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdPrioritasPembangunanDaerah */
?>
<div class="ta-rpjmd-prioritas-pembangunan-daerah-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'No_Prioritas',
            'Prioritas_Pembangunan_Daerah:ntext',
        ],
    ]) ?>

</div>
