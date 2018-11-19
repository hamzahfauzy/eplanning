<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaMisi */

$this->title = 'Tambah Rencana Strategis Misi '.( date('Y')+1 );
$this->params['breadcrumbs'][] = "Rencana Strategis";
$this->params['breadcrumbs'][] = ['label' => 'Data Misi', 'url' => ['index']];
$this->params['breadcrumbs'][] = "tambah";
?>
<div class="ta-misi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
