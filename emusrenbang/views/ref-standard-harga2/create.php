<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStandardHarga2 */

$this->title = 'Create Ref Standard Harga2';
$this->params['breadcrumbs'][] = ['label' => 'Ref Standard Harga2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-standard-harga2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
