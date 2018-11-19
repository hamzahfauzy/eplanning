<?php
namespace userlevel\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use userlevel\models\TU3Form;
use userlevel\models\TU4Form;
use userlevel\models\RefKabupaten;
use userlevel\models\RefKecamatan;
use userlevel\models\RefKelurahan;
use userlevel\models\RefLevel;
use userlevel\models\TaProfile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionIsiprofil(){
		$model = new TaProfile();
		$session = Yii::$app->session;
		$session->open();
		if ($model->load(Yii::$app->request->post())) {
			$session = Yii::$app->session;
			$session->open();
			$teks = $session['user_id'];
            if ($model->signup($teks) == 1){
				//Yii::$app->session->setFlash('contactFormSubmitted');
				//$this->redirect(['isiprofil']);
				$session->close();
				//$session->destroy();
				$this->redirect(['isi-asal']);
				//return $this->refresh();
			}
			
            
        }
		return $this->render('isiprofil', [
            'model' => $model,
        ]);
	}
	
	public function actionIsiAsal(){
		$model = new TU3Form();
		if ($model->load(Yii::$app->request->post())) {
			$session = Yii::$app->session;
			$session->open();
			$teks = $session['user_id'];
			//$id = $model->j_user;
			//echo "<script type='text/javascript'>alert('$id');</script>";
            if ($model->signup($teks) == 1){
				//Yii::$app->session->setFlash('contactFormSubmitted');
				$this->redirect(['isi-hak-akses']);
				$session->close();
				//$session->destroy();
				//$this->redirect(['isi-asal']);
				//return $this->refresh();
			}
		}
		return $this->render('IsiAsal', [
			'model' => $model,
    ]);

	}
	
	public function actionAsal()//, $idkab, $idkec, $idkel)
	{
		$request = Yii::$app->request;
		$obj = $request->post('obj');
		$value = $request->post('value');
		$jenis = $request->post('jenis');
		switch ($obj) {
			case 'prov':
				$data = RefKabupaten::find()->where(['Kd_Prov' => $value[0]])->all();
				$idtable = 'Kd_Kab';
				$nama = 'Nm_Kab';
			break;
			case 'kab':
				$data = RefKecamatan::find()->where(['Kd_Prov' => $value[0]])->andWhere(['Kd_Kab' => $value[1]])->all();
				$idtable = 'Kd_Kec';
				$nama = 'Nm_Kec';
			break;
			case 'kec':
				$data = RefKelurahan::find()->where(['Kd_Prov' => $value[0]])->andWhere(['Kd_Kab' => $value[1]])->andWhere(['Kd_Kec' => $value[2]])
				->all();
				$idtable = 'Kd_Kel';
				$nama = 'Nm_Kel';
				//$data = Village::find()->where([$obj => $value])->all();
			break;
			case 'j_user':
				if ($jenis == 1){
					$data = RefLevel::find()->all();
				}else{
					$data = RefLevel::find()->where(['Kd_Level' => '3'])->all();
				}
				$idtable = 'Kd_Level';
				$nama = 'Nm_Level';
			break;
		}
		$tagOptions = ['prompt' => "=== Select ==="];
		//print_r($data);
		return Html::renderSelectOptions([], ArrayHelper::map($data, $idtable, $nama), $tagOptions);
	}
	
	public function actionIsiHakAkses()
	{
		$model = new TU4Form();
		if ($model->load(Yii::$app->request->post())) {
			$session = Yii::$app->session;
			$session->open();
			$session['user_id'] = "23";
			$teks = $session['user_id'];
			$name = $model->optk2;
			$err = var_dump($model->signup($teks));
			echo "<script type='text/javascript'>alert('$name');</script>";
				//Yii::$app->session->setFlash('contactFormSubmitted');
				//$this->redirect(['isi-hak-akses']);
				$session->close();
				$session->destroy();
				//$this->redirect(['isi-asal']);
				//return $this->refresh();
			
        }
		return $this->render('IsiHakAkses', [
			'model' => $model,
		]);

	}

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
