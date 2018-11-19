<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKecamatanMedia */

$this->title = 'Create Ta Musrenbang Kecamatan Media';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kecamatan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kecamatan-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
