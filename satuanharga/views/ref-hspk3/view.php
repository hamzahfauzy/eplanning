<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk3 */
?>
<div class="ref-hspk3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdHspk1.kdHspk1.Nm_Hspk1',
            'kdHspk1.Nm_Hspk2',
            'Nm_Hspk3',
            'kode',
        ],
    ]) ?>

</div>
