<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb3 */
?>
<div class="ref-asb3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdAsb1.kdAsb1.Nm_Asb1',
            'kdAsb1.Nm_Asb2',
            'Nm_Asb3',
            'kode',
        ],
    ]) ?>

</div>
