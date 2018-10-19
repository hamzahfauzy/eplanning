<?php
//use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
?>
<div class="ta-musrenbang-kecamatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if($model !== null) : ?>
	
	<?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [                      // the owner name of the model
            'label' => 'Nama',
            'value' => $model->Nm_Lengkap,
        ],
		[                      // the owner name of the model
            'label' => 'Tanggal Lahir',
            'value' => $model->Tgl_Lahir,
        ],
		[                      // the owner name of the model
            'label' => 'Alamat',
            'value' => $model->Alamat,
        ],
		[                      // the owner name of the model
            'label' => 'Nomor Telepon',
            'value' => $model->Telp,
        ],
		[                      // the owner name of the model
            'label' => 'Nomor HP',
            'value' => $model->Mobile,
        ],
         // creation date formatted as datetime
    ],
]);?>
    <?php else : ?>
    
    <h1>Data Pofil Belum Lengkap, silahkan lengkapi Data profil Anda</h1>
    <?php endif; ?>
</div>