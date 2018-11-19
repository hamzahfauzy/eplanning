<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetailKegiatan */

$this->title = 'Tambah Detail Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Detail Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="detail-kegiatan-create">

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
