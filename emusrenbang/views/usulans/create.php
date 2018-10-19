<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usulans */

$this->title = 'Tambah Usulans';
$this->params['breadcrumbs'][] = ['label' => 'Usulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usulans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
