<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh2 */
?>
<div class="ref-ssh2-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataSsh' => $dataSsh,
    ]) ?>

</div>
