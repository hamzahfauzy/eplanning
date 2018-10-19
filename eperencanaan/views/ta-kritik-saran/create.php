<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKritikSaran */

$this->title = 'Create Ta Kritik Saran';
$this->params['breadcrumbs'][] = ['label' => 'Ta Kritik Sarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kritik-saran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
