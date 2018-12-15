<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header"  >

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/> -->
                        <?php echo Html::img('@web/images/logo.png', ['class'=>'user-image', 'alt'=>'User Image']) ?>
                        <span class="hidden-xs"><?= \Yii::$app->user->identity->username ?> <?= \Yii::$app->user->identity->nama_lengkap ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php echo Html::img('@web/images/logo.png', ['class'=>'img-circle', 'alt'=>'User Image']) ?>
                            <!--<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>-->

                            <p>
								<?= \Yii::$app->user->identity->username ?>
                                <?= \Yii::$app->user->identity->nama_lengkap ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#"></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"></a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-success btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
									   
                           <!--   <a href="http://eplanning.asahankab.go.id/eperencanaan/emusrenbang/web/index.php?r=site%2Flogout&pesan=uji" data-method = 'post', class = 'btn btn-danger btn-flat']>Sign Out</a> -->
							    <?=
                                Html::a(
                                        'Sign out', ['/site/logout'],['data-method' => 'post', 'class' => 'btn btn-danger btn-flat'] 
                                )
                                ?> 
								

                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
