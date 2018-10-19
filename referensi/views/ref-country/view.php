<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefCountry */
?>
<div class="ref-country-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Benua','value' => $model->kdSubBenua->kdBenua->Nm_Benua],
            ['label' => 'Sub Benua','value' => $model->kdSubBenua->Nm_Benua_Sub],
            ['label' => 'Kode Negara','value' => $model->Kd_Benua_Sub_Negara],
            ['label' => 'Nama Negara','value' => $model->Nm_Negara],
        ],
    ]) ?>

</div>
