<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh3 */
?>
<div class="ref-ssh3-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataSsh' => $dataSsh,
        'dataSsh2' => $dataSsh2,
    ]) ?>

</div>
