<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefApPub */

$this->title = 'Create Ref Ap Pub';
$this->params['breadcrumbs'][] = ['label' => 'Ref Ap Pubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ap-pub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
