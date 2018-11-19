<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\MenuAssignmentLevel;
use emusrenbang\models\MenuAssignmentLevelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Referensi;

/**
 * MenuAssignmentLevelController implements the CRUD actions for MenuAssignmentLevel model.
 */
class MenuAssignmentLevelController extends Controller
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
     * Lists all MenuAssignmentLevel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuAssignmentLevelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuAssignmentLevel model.
     * @param string $level
     * @param integer $id_menu
     * @return mixed
     */
    public function actionView($level, $id_menu)
    {
        return $this->render('view', [
            'model' => $this->findModel($level, $id_menu),
        ]);
    }

    /**
     * Creates a new MenuAssignmentLevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuAssignmentLevel();
        $ref= new Referensi();
        $level=$ref->getLevel();
        $menus=$ref->getMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'level' => $model->level, 'id_menu' => $model->id_menu]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'level' => $level,
                'menus' => $menus,
            ]);
        }
    }

    /**
     * Updates an existing MenuAssignmentLevel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $level
     * @param integer $id_menu
     * @return mixed
     */
    public function actionUpdate($level, $id_menu)
    {
        $model = $this->findModel($level, $id_menu);
        $ref= new Referensi();
        $level=$ref->getLevel();
        $menus=$ref->getMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'level' => $model->level, 'id_menu' => $model->id_menu]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'level' => $level,
                'menus' => $menus,
            ]);
        }
    }

    /**
     * Deletes an existing MenuAssignmentLevel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $level
     * @param integer $id_menu
     * @return mixed
     */
    public function actionDelete($level, $id_menu)
    {
        $this->findModel($level, $id_menu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuAssignmentLevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $level
     * @param integer $id_menu
     * @return MenuAssignmentLevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($level, $id_menu)
    {
        if (($model = MenuAssignmentLevel::findOne(['level' => $level, 'id_menu' => $id_menu])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
