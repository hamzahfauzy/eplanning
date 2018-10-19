<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model emusrenbang\models\RefUnitApbn */

$this->title = 'Create Ref Unit Apbn';
$this->params['breadcrumbs'][] = ['label' => 'Ref Unit Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-unit-apbn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
