<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh5 */
?>
<div class="ref-ssh5-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataSsh' => $dataSsh,
        'dataSsh2' => $dataSsh2,
        'dataSsh3' => $dataSsh3,
        'dataSsh4' => $dataSsh4,
    ]) ?>

</div>
