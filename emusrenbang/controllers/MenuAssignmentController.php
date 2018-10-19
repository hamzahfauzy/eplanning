<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\MenuAssignment;
use emusrenbang\models\MenuAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Referensi;

/**
 * MenuAssignmentController implements the CRUD actions for MenuAssignment model.
 */
class MenuAssignmentController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MenuAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuAssignment model.
     * @param string $username
     * @param integer $id_menu
     * @return mixed
     */
    public function actionView($username, $id_menu)
    {
        return $this->render('view', [
            'model' => $this->findModel($username, $id_menu),
        ]);
    }

    /**
     * Creates a new MenuAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuAssignment();
        $ref= new Referensi();
        $users=$ref->getUser();
        $menus=$ref->getMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'username' => $model->username, 'id_menu' => $model->id_menu]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'users' => $users,
                'menus' => $menus,
            ]);
        }
    }

    /**
     * Updates an existing MenuAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $username
     * @param integer $id_menu
     * @return mixed
     */
    public function actionUpdate($username, $id_menu)
    {
        $model = $this->findModel($username, $id_menu);
        $ref= new Referensi();
        $users=$ref->getUser();
        $menus=$ref->getMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'username' => $model->username, 'id_menu' => $model->id_menu]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users' => $users,
                'menus' => $menus,
            ]);
        }
    }

    /**
     * Deletes an existing MenuAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $username
     * @param integer $id_menu
     * @return mixed
     */
    public function actionDelete($username, $id_menu)
    {
        $this->findModel($username, $id_menu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $username
     * @param integer $id_menu
     * @return MenuAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username, $id_menu)
    {
        if (($model = MenuAssignment::findOne(['username' => $username, 'id_menu' => $id_menu])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
