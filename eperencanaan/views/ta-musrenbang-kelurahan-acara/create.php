<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahanAcara */

$this->title = 'Create Ta Musrenbang Kelurahan Acara';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahan Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-acara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
