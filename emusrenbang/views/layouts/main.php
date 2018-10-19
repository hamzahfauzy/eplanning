<?php
/* @var $this \yii\web\View */
/* @var $content string */

use emusrenbang\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use mdm\admin\components\MenuHelper;

if (!empty(Yii::$app->user->identity->id)) {
    $items = MenuHelper::getAssignedMenu(Yii::$app->user->identity->id);
} else {
    $items = array();
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php if (!Yii::$app->user->isGuest) { ?>
            <meta http-equiv="refresh" content="<?php echo Yii::$app->params['sessionTimeoutSeconds'] + 10; ?>;" />
        <?php } ?>
        <?php $this->head() ?>
    </head>
    <body class="layout layout-header-fixed">
        <?php $this->beginBody() ?>
        <div class="layout-header">
            <?php include("header.php"); ?>
        </div>
        <div class="layout-main">

            <div class="layout-sidebar">
			
                <?=
                dmstr\widgets\Menu::widget(
                        [
                            'options' => ['class' => 'sidebar-menu'],
                            'items' => $items,
                        ]
                )
                ?>
            </div>



            <style type="text/css">
                .layout-content{
                    background: #fafafa;
                }
                .content-custome{
                    padding:10px;
                }

                table{
                    font-size: 15px;
                }

                table tr{
                    background: #fff !important;
                }

                .title-bar-description{
                    margin-top: 5px;
                }
            </style>
            <div class="layout-content">
                <div class="layout-content-body">
                    <div class="title-bar">
                        <h1 class="title-bar-title">
                            <span class="d-ib">
                                <?php
                                if (isset($this->blocks['content-header'])) {
                                    echo $this->blocks['content-header'];
                                } else {
                                    if ($this->title !== null) {
                                        echo \yii\helpers\Html::encode($this->title);
                                    } else {
                                        echo \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id));
                                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                                    }
                                }
                                ?>
                            </span>
                        </h1>
                        <p class="title-bar-description">
                            <?=
                            Breadcrumbs::widget([
                                'homeLink' => ['label' => 'Beranda',
                                    'url' => Yii::$app->getHomeUrl()],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ])
                            ?>
                        </p>
                    </div>
                    <div>
                        <?= Alert::widget() ?>
                    </div>
                    <div class="row gutter-xs">
                        <div class="content-custome">
                            <?= $content; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layout-footer">
                <div class="layout-footer-body">
                    <!-- <small class="version">Version 1.1</small> -->
                    <small class="copyright">Bappeda Provinsi Sumatera Utara 2016 © eplanning.sumutprov.go.id</small>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>