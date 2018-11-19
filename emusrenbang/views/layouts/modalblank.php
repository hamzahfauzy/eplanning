<?php

/* @var $this \yii\web\View */
/* @var $content string */

use emusrenbang\assets\AppAssetModal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAssetModal::register($this);

$js="$('[id^=\"ssh3_\"]').click(function(){
	v=$(this).val();
	s=v.split('_');
	$('#Ket').val(s[1]);
    $('#Nilai_Rp').val(s[0]);
	$('#Nilai_Rp_1').val(currency(s[0]));
	// $('#Sat_1').val(s[2]);
	$('#Sat_1 option[value='+s[2]+']').prop('selected', true);
	$('#Satuan123').val(s[2]);
	$('#responsive').modal('hide');
});

";
$this->registerJs($js, 4, 'My');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="refresh" content="<?php echo Yii::$app->params['sessionTimeoutSeconds']; ?>;" />
    <?php $this->head() ?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php $this->beginBody() ?>

			<?= $content; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
