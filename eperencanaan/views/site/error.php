<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

?>
<div class="site-error">
   <!--<h1><?=Html::encode($this->title) ?></h1> -->
 

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
       Server memproses permintaan Anda tetapi
		Kemungkinan Akun Anda Sudah DINONAKTIFKAN!
    </p>
    <p>
        Silakan hubungi Bappeda untuk informasi lebih lanjut. Terima kasih.
    </p>

</div>
