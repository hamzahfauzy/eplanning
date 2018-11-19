<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaIdentitas */
?>
<div class="ta-identitas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Hostname',
            'Ip_Public',
            'Logo',
            'Nm_Instansi',
            'Created_At',
            'Status',
            'Email:email',
        ],
    ]) ?>

</div>
