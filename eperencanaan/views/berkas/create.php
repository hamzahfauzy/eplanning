<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaMusrenbangKelurahanMedia */

$this->title = 'Create Ta Musrenbang Kelurahan Media';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
