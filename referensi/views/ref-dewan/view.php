<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\RefDewan */
?>
<div class="ref-dewan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'refDapil.Nm_Dapil',
            'Kd_Dewan',
            'Nm_Dewan',
        ],
    ]) ?>

</div>
