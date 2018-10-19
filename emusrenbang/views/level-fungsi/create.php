<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LevelFungsi */

$this->title = 'Tambah Level Fungsi';
$this->params['breadcrumbs'][] = ['label' => 'Level Fungsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-fungsi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
