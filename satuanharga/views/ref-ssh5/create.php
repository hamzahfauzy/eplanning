<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RefSsh5 */

?>
<div class="ref-ssh5-create">
    <?= $this->render('_form', [
        'model' => $model,
           'dataSsh' => $dataSsh,
    ]) ?>
</div>
