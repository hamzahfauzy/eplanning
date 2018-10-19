<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefCountry */
?>
<div class="ref-country-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            'Nm_Negara',
        ],
    ]) ?>

</div>
