<?php
namespace eperencanaan\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\TaUserAplikasi;
use yii\helpers\Json;
use eperencanaan\models\Savelog;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main-front';
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

    public function actionDodol()
    {
        $data = Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id);
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        echo "<hr>";
        echo "isi json <br/>";
        $isi_json = json_encode($data);
        echo $isi_json;

        echo "<hr>";
        echo "isi serialize <br/>";
        $isi_serialize = serialize($data);
        echo $isi_serialize;

        echo "<hr>";
        echo "balikan json <br/>";
        $balik_json = json_decode($isi_json);
        echo "<pre>";
        print_r($balik_json);
        echo "</pre>";

        echo "<hr>";
        echo "balikan serialize <br/>";
        $isi_serialize = unserialize($isi_serialize);
        echo "<pre>";
        print_r($isi_serialize);
        echo "</pre>";

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            //disini filter berdasarkn level
            return $this->goHome();
        }

        $model = new LoginForm();
        //$DNModelAplikasi = new TaUserAplikasi();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        	$id = Yii::$app->user->id;
        	//$idAplikasi = Yii::$app->id;
        	//echo $idAplikasi;
        	//$DNModelAplikasi->find()->where(['Kd_User'=>$id, 'Kd_Aplikasi'=>$idAplikasi])->one();
        	//if(!empty($DNModelAplikasi['Kd_User'])){
            //sama disini juga
            return $this->goHome();
            //}else{
            //	echo "Anda tidak diijinkan untuk akses aplikasi ini";
            //}
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
		Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
        $log = new Savelog();
        $log->save('logout berhasil', 'logout', '', '');
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionFaq(){
        return $this->render('faq');
    }
}
