<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaCapaianProgram */

$this->title = 'Tambah Ta Capaian Program';
$this->params['breadcrumbs'][] = ['label' => 'Ta Capaian Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-capaian-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formcapaian', [
        'model' => $model,
    ]) ?>

</div>
