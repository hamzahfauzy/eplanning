<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaCapaianProgram */

$this->title = 'Tambah Ta Capaian Program';
$this->params['breadcrumbs'][] = ['label' => 'Renja Program', 'url' => ['ref-program/createskpd']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-capaian-program-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
