<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LevelAssignment */

$this->title = 'Tambah Level Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Level Assignment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-assignment-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
