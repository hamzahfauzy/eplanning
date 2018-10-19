<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb2 */
?>
<div class="ref-asb2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdAsb1.Nm_Asb1',
            'Nm_Asb2',
            'kode',
        ],
    ]) ?>

</div>
