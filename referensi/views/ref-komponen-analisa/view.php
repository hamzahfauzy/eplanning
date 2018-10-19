<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKomponenAnalisa */
?>
<div class="ref-komponen-analisa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Komponen',
            'Nm_Komponen',
        ],
    ]) ?>

</div>
