<?php

use yii\helpers\Html;
use common\models\RefUrusan;

/* @var $this yii\web\View */
/* @var $model common\models\TaPaguSubUnit */

$this->title = 'Tambah Pagu Sub Unit';
$this->params['breadcrumbs'][] = ['label' => 'Pagu Sub Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pagu-sub-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
        'urusan' => RefUrusan::find()->select('Nm_Urusan')->indexBy('Kd_Urusan')->column(),
    ]) ?>

</div>
