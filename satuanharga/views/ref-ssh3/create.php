<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RefSsh3 */

?>
<div class="ref-ssh3-create">
    <?= $this->render('_form', [
        'model' => $model,
         'dataSsh' => $dataSsh,
    ]) ?>
</div>
