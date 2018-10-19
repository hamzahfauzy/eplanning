<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh4 */
?>
<div class="ref-ssh4-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataSsh' => $dataSsh,
        'dataSsh2' => $dataSsh2,
        'dataSsh3' => $dataSsh3,
    ]) ?>

</div>
