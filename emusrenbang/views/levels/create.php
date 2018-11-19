<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Levels */

$this->title = 'Tambah Level';
$this->params['breadcrumbs'][] = ['label' => 'Level', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="levels-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
