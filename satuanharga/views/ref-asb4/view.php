<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb4 */
?>
<div class="ref-asb4-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdAsb1.kdAsb1.kdAsb1.Nm_Asb1',
            'kdAsb1.kdAsb1.Nm_Asb2',
            'kdAsb1.Nm_Asb3',
            'Nm_Asb4',
            'kode',
        ],
    ]) ?>

</div>
