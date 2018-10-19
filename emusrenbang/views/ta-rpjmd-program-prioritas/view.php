<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdProgramPrioritas */
?>
<div class="ta-rpjmd-program-prioritas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            [
                'label' => 'Misi',
                'value' => '('.@$model->taRpjmdMisi->No_Misi.') '.@$model->taRpjmdSasaran->taRpjmdTujuan->taRpjmdMisi->Misi,
            ],
            [
                'label' => 'Tujuan',
                'value' => '('.@$model->No_Tujuan.') '.@$model->taRpjmdSasaran->taRpjmdTujuan->Tujuan,
            ],
            [
                'label' => 'Sasaran',
                'value' => '('.@$model->No_Sasaran.') '.@$model->taRpjmdSasaran->Sasaran,
            ],
			[
                'label' => 'Prioritas Pembangunan Daerah (RPJMD)',
                'value' => '('.@$model->No_Prioritas.') '.@$model->refRPJMD2->Keterangan,
            ],
            [
                'label' => 'Prioritas Pembangunan Daerah (RKPD)',
                'value' => '('.@$model->No_Prioritas.') '.@$model->refRPJMD2->Nm_Prioritas_Pembangunan_Kota,
            ],
           /* [
                'label' => 'Program',
                'value' => '('.@$model->No_Prioritas.') '.@$model->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah,
            ],*/
            [
                'label' => 'Program',
                'value' => '('.@$model->Kd_Prog.') '.@$model->refProgram->Nm_Program,
            ],
        ],
    ]) ?>

</div>
