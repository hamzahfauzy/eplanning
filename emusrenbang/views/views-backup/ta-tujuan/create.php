<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaTujuan */

$this->title = 'Tujuan';
$this->params['breadcrumbs'][] = ['label' => 'Tujuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
