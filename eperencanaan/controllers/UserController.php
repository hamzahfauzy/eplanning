<?php

namespace eperencanaan\controllers;
use eperencanaan\models\TaProfile;

use Yii;

class UserController extends \yii\web\Controller {

    public function actionIndex() {
        $ZULmodel = TaProfile::findOne(['Kd_User' => Yii::$app->user->identity->id]);
        return $this->render('index', ['model' => $ZULmodel]);
    }

    public function actionUpdate($id) {
        $ZULmodel = TaProfile::findOne(['Kd_User' => $id]);
        if ($ZULmodel->load(Yii::$app->request->post()) && $ZULmodel->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $ZULmodel,
            ]);
        }
    }

    public function actionPassword($id) {
        $user = $this->findModel($id);
        $loadedPost = $user->load(\Yii::$app->request->post());
        $model = new \frontend\models\ChangePassword();


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->password = 'webmaxindo';
            $user->save(false);
            \Yii::$app->session->addFlash('success', 'You have successfully changed your password.');
            return $this->refresh();
        }

        return $this->render('reset-password', [
                    'user' => $user,
                    'model' => $model,
        ]);
    }

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

    public function actionUploadFoto() {
        $ZULmodel = new \yii\base\DynamicModel(['Foto']);
        $ZULmodel->addRule('Foto', 'file', ['skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg']);
        $ZULmodel->addRule('Foto', 'safe');
        //print_r(Yii::$app->request->post());exit;
        $ZULmodel->load(Yii::$app->request->post());
        $ZULUser = \eperencanaan\models\TaProfile::findOne(['Kd_User' => Yii::$app->user->identity->id]);
        $ZULmodel->Foto = \yii\web\UploadedFile::getInstanceByName("Foto");
        //echo var_dump($ZULmodel->Foto);exit;
        $path = realpath(dirname(dirname(dirname(__FILE__)))) . '/userlevel/web/uploads/' . Yii::$app->user->identity->id . '.' . $ZULmodel->Foto->extension;
        if (file_exists($path))
            unlink($path);
        $ZULmodel->Foto->saveAs($path);
        $ZULUser->Foto = Yii::$app->user->identity->id . '.' . $ZULmodel->Foto->extension;
        $ZULUser->save(false);

        return $this->redirect(['user/index']);
    }

}
