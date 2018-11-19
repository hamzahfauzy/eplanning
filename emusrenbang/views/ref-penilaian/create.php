<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaian */

$this->title = 'Create Ref Penilaian';
$this->params['breadcrumbs'][] = ['label' => 'Referensi Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
