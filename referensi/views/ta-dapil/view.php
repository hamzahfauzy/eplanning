<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaDapil */
?>
<div class="ta-dapil-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'refDapil.Nm_Dapil',
            'refProvinsi.Nm_Prov',
            'refKabupaten.Nm_Kab',
            'refKecamatan.Nm_Kec',
        ],
    ]) ?>

</div>
