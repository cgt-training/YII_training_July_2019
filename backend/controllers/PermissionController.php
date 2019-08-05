<?php

namespace backend\controllers;

use Yii;
use backend\models\Permission;
use backend\models\PermissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BranchController implements the CRUD actions for Branch model.
 */
class PermissionController extends Controller
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
     * Lists all Branch models.
     * @return mixed
     */


    public function actionIndex()
    {
        $searchModel = new PermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $typeArr=array('1'=>'Role','2'=>'Auth_rule');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'typeArr' => $typeArr,
        ]);
    }

    /**
     * Displays a single Branch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $typeArr=array('1'=>'Role','2'=>'Auth_rule');
        return $this->render('view', [
            'model' => $this->findModel($id),
            'typeArr' => $typeArr,
        ]);
    }

    /**
     * Creates a new Branch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $auth = Yii::$app->authManager;
        $model = new Permission();

        if ($model->load(Yii::$app->request->post())) {
            $request= Yii::$app->request->post();
            
            $request=$request['Permission'];
            $createPost = $auth->createPermission($request['name']);
            $createPost->description =$request['description'];
            $createPost->type =$request['type'];

            if (!$model->validate()) {            
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            $auth->add($createPost);


            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $auth = Yii::$app->authManager;

        if ($model->load(Yii::$app->request->post())) {

            $request= Yii::$app->request->post();
            $request=$request['Permission'];
            $createPost = $auth->createPermission($request['name']);
            $createPost->description =$request['description'];
            $createPost->type =$request['type'];

            if (!$model->validate()) {            
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            $auth->update($id,$createPost);

             return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Branch model.
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
     * Finds the Branch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}


