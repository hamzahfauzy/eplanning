<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Satuan */

$this->title = 'Create Satuan';
$this->params['breadcrumbs'][] = ['label' => 'Satuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
