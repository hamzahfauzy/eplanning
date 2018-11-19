<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk2 */
?>
<div class="ref-hspk2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdHspk1.Nm_Hspk1',
            'Nm_Hspk2',
            'kode',
        ],
    ]) ?>

</div>

