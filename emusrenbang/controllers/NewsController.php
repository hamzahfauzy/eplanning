<?php

namespace emusrenbang\controllers;

use Yii;
use emusrenbang\models\News;
use emusrenbang\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        $folder='uploads/news/';

        if ($model->load(Yii::$app->request->post())){

            $model->create_at=time();
    		$model->update_at=0;
    		$model->username=Yii::$app->user->username;
    		$model->view=0;
    		$model->hit=0;
    		$title=explode(" ", $model->title);
			$title_seo="";
    		foreach($title as $t){
    			if($title_seo==""){
    				$title_seo.=strtolower($t);
    			}else{
    				$title_seo.="-".strtolower($t);
    			}

    		}
    		$t_seo=$this->cekSeoTitle($title_seo,0);
    		$model->title_seo=$t_seo;

            if($model->save()) {
                if(!empty($_FILES['News']['name']['file'])){
                    $namefiledata=$_FILES['News']['name']['file'];
                    $tmpfiledata=$_FILES['News']['tmp_name']['file'];
                    $info=pathinfo($namefiledata);
                    $ext=$info['extension'];
                    $filed="news".$model->id.".".$ext;
                    if( !file_exists($folder) ){
                        mkdir($folder, 0777, true);
                    }

                    copy($tmpfiledata, $folder.$filed);

                    $sql="UPDATE news SET file='$filed' WHERE id='$model->id'";
                    Yii::$app->db->createCommand($sql)->execute();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    private function cekSeoTitle($id, $i)
    {
    		$getID=News::findOne(['title_seo'=>$id]);
        	if($getID['id'] !=""){
        		if($i==0){
        			$i=1;
        		}else{
        			$i=$i+1;
        		}
        		$seo=$id."-".$i;
        		$title_seo=$this->cekSeoTitle($seo, $i);
        	}else{
        		$title_seo=$id;
        	}
        	return $title_seo;
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $folder='uploads/news/';
        $model = $this->findModel($id);

        $file=$model->file;
        if ($model->load(Yii::$app->request->post())) {
            if(!empty($_FILES['News']['name']['file'])){
                $namefiledata=$_FILES['News']['name']['file'];
                $tmpfiledata=$_FILES['News']['tmp_name']['file'];
                $info=pathinfo($namefiledata);
                $ext=$info['extension'];
                $filed="news".$model->id.".".$ext;
                $model->file=$filed;
                if( !file_exists($folder) ){
                    mkdir($folder, 0777, true);
                }

                copy($tmpfiledata, $folder.$filed);
            }else{
                $model->file=$file;
            }
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
