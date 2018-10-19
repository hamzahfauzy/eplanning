<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJurnal */
?>
<div class="ref-jurnal-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Jurnal',
            'Nm_Jurnal',
        ],
    ]) ?>

</div>
