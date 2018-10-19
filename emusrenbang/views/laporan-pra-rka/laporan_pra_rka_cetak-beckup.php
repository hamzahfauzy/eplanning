<?php
    \moonland\phpexcel\Excel::widget([
        'models' => $model,
        'mode' => 'export', //default value as 'export'
        'columns' => [
            [
                'attribute' => 'content',
                'header' => 'OPD',
                'format' => 'text',
                'value' => function($model) {
                    $nama_sub = $model->refSubUnit->Nm_Sub_Unit;
                    return $nama_sub;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Program',
                'format' => 'text',
                'value' => function($model) {
                    $program = $model->refProgram->Ket_Program;
                    if (isset($program)) {
                        $program;
                    }
                    else {
                        $program = '';    
                    }
                    return $program;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Pagu Indikatif',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->pagu['pagu'] == '') {
                        $pagu = 0;
                    }
                    else {
                        $pagu = $model->pagu->pagu;
                    }
                    return $pagu;
                },
            ],
        ],
    ]);
?>