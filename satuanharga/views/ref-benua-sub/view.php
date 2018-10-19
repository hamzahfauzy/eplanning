<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefBenuaSub */
?>
<div class="ref-benua-sub-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Nm_Benua_Sub',
        ],
    ]) ?>

</div>
