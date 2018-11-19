<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRek3 */

$this->title = 'Tambah Referensi Rekening Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Referensi Rekening Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rek3-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
