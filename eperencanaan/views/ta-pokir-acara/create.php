<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaPokirAcara */

$this->title = 'Create Ta Pokir Acara';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pokir Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pokir-acara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
