<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh */
?>
<div class="ref-ssh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdSsh1.kdSsh1.kdSsh1.kdSsh1.kdSsh1.Nm_Ssh1',
            'kdSsh1.kdSsh1.kdSsh1.kdSsh1.Nm_Ssh2',
            'kdSsh1.kdSsh1.kdSsh1.Nm_Ssh3',
            'kdSsh1.kdSsh1.Nm_Ssh4',
            'kdSsh1.Nm_Ssh5',
            'kode',
            'Nama_Barang',
            'Kd_Satuan',
            'Harga_Satuan',
        ],
    ]) ?>

</div>
