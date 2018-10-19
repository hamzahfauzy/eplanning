<?php

namespace userlevel\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;
use yii\base\UserException;
use common\models\User;
use userlevel\models\searchs\User as UserSearch;
use userlevel\models\TaUserUnit;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;


/**
 * User controller
 */
class UserController extends Controller
{
    private $_oldMailPath;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup','getbidang','getunit','getsubunit'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','getbidang','getunit','getsubunit'],
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['/site/index']);
                    throw new \Exception('You are not allowed to access this page');
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post'],
                    'activate' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
                /* @var $mailer BaseMailer */
                $this->_oldMailPath = $mailer->getViewPath();
                $mailer->setViewPath('@mdm/admin/mail');
            }
            return true;
        }
        return false;
    }

    public function afterAction($action, $result)
    {
        if ($this->_oldMailPath !== null) {
            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
        }
        return parent::afterAction($action, $result);
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $sql="delete from Ta_User_Unit where Kd_User='$id'";
        Yii::$app->db->createCommand($sql)->execute();

        return $this->redirect(['index']);
    }
	
	public function actionAPI(){
		$model = new User();
		print_r($model);
	}

    public function actionCreate()
    {
        $model = new User();

        if(Yii::$app->user->identity){
            $modelTaUser = TaUserUnit::findUser(Yii::$app->user->identity->id);
        }else{
            $modelTaUser = new TaUserUnit();
        }

        if ($model->load(Yii::$app->request->post())) {
                $password=$model->password_hash;
                $model->password_hash=Yii::$app->security->generatePasswordHash($password);
                $model->auth_key = Yii::$app->security->generateRandomString();
                $model->created_at=time();
                $model->updated_at=time();
                if($model->save()){
                    if(Yii::$app->user->identity){
                        $modelTaUserNew = new TaUserUnit();
                        $modelTaUserNew->Kd_Urusan=$modelTaUser->Kd_Urusan;
                        $modelTaUserNew->Kd_Bidang=$modelTaUser->Kd_Bidang;
                        $modelTaUserNew->Kd_Unit=$modelTaUser->Kd_Unit;
                        $modelTaUserNew->Kd_Sub_Unit=$modelTaUser->Kd_Sub_Unit;
                        $modelTaUserNew->Kd_User=$model->id;
                        $modelTaUserNew->save();
                    }else{
                        if ($modelTaUser->load(Yii::$app->request->post())) {
                            $modelTaUser->Kd_User=$model->id;
                            $modelTaUser->save();
                        }
                    }
                    $this->redirect(['index']);
                }else{
                    return $this->render('create', [
                        'model'         => $model,
                        'modelTaUser'   =>$modelTaUser
                    ]);
                }

        } else {
            return $this->render('create', [
                'model'         => $model,
                'modelTaUser'   =>$modelTaUser
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model       = $this->findModel($id);
        $modelTaUser = new TaUserUnit();
        $modelTaUserBy = TaUserUnit::findUser($id);

        if($modelTaUserBy){
            $modelTaUser=$modelTaUserBy;
        }

        if ($model->load(Yii::$app->request->post())){
            $post=Yii::$app->request->post();
            if($model->password_hash!==$post['User']['password_hash1']){
                $password=$model->password_hash;
                $model->password_hash=Yii::$app->security->generatePasswordHash($password);
                $model->auth_key = Yii::$app->security->generateRandomString();
            }
            if($model->save()) {
                if ($modelTaUser->load(Yii::$app->request->post())) {
                    if(!$modelTaUserBy){
                        $modelTaUser->Kd_User=$model->id;
                        $modelTaUser->save();
                    }else{
                        $sql="update Ta_User_Unit set
                            Kd_Urusan='$modelTaUser->Kd_Urusan',
                            Kd_Bidang='$modelTaUser->Kd_Bidang',
                            Kd_Unit='$modelTaUser->Kd_Unit',
                            Kd_Sub_Unit='$modelTaUser->Kd_Sub_Unit'
                            where Kd_User='$modelTaUser->Kd_User'";

                        Yii::$app->db->createCommand($sql)->execute();
                    }
                }
                $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelTaUser'=>$modelTaUser
            ]);
        }
    }

    /**
     * Login
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }

    /**
     * Signup new user
     * @return string
     */
    public function actionSignup()
    {
        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }

        return $this->render('signup', [
                'model' => $model,
        ]);
    }

    /**
     * Request reset password
     * @return string
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    
    // public function actionChangePassword()
    // {
    //     // $model = new ChangePassword();
    //     $model = new \eperencanaan\models\ResetPasswordProfil();

    //     if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
    //         return $this->goHome();
    //     }

    //     return $this->render('change-password', [
    //             'model' => $model,
    //     ]);
    // }

    public function actionChangePassword() {
        $model = new \eperencanaan\models\ResetPasswordProfil();

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            \Yii::$app->session->addFlash('success', 'You have successfully changed your password.');
            return $this->refresh();
        }

        return $this->render('change-password', [
                    'model' => $model,
        ]);
    }

    /**
     * Activate new user
     * @param integer $id
     * @return type
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function actionActivate($id)
    {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_INACTIVE) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                return $this->goHome();
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->goHome();
    }
	 public function actionInactivate($id)
    {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_ACTIVE) {
            $user->status = User::STATUS_INACTIVE;
            if ($user->save()) {
                return $this->goHome();
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->goHome();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
