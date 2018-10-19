<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSumberDana */

$this->title = 'Tambah Ref Sumber Dana';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sumber Danas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sumber-dana-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
