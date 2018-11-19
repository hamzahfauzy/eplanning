<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStandardSatuan */

$this->title = 'Create Ref Standard Satuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Satuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-standard-satuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
