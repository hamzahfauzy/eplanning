<?php

/* @var $this yii\web\View */

$this->title = 'Aplikasi Manajemen User';

?>
<div class="site-index">

    <div class="jumbotron text-center">
        <h1>Selamat Datang di <br> Aplikasi Manajemen User.</h1>

		<?php
			$a=Yii::$app->levelcomponent->getKelompok();
			print_r($a);
		?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <p>
                    <br><br>
                </p>
                <p>
                    <br><br>
                </p>
                <p>
                    <br><br>
                </p>
                <p>
                    <br><br>
                </p>
            </div>
        </div>

    </div>
</div>
