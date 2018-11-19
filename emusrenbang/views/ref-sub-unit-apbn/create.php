<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model emusrenbang\models\RefSubUnitApbn */

$this->title = 'Create Ref Sub Unit Apbn';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sub Unit Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-unit-apbn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
