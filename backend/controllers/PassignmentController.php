<?php

namespace backend\controllers;

use Yii;
use backend\models\Passignment;
use backend\models\PermissionSearch;
use backend\models\PassignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BranchController implements the CRUD actions for Branch model.
 */
class PassignmentController extends Controller
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
        $searchModel = new PassignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($parent)
    {
        
        $model = new Passignment();
        $child = $model->find()->where(['parent' => $parent])->all();
        foreach ($child as $key => $value) {
            $listper[]=$value->child;
        }        
      
        $model->child = $child;
        $model->parent=$parent;
        return $this->render('view', [
            'model' => $this->findModel($parent),
            'child' => $model,
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
        $model = new Passignment();
        $searchModel=new PermissionSearch();
        $allParent=  $searchModel->find()->where('type = :type', [':type' => '1'])
->all();
        $allRule=  PermissionSearch::find()->where('type = :type', [':type' => '2'])
->all();

        $listper=array();
        $authitemchilds = new PassignmentSearch();
       
       
        $authitemchilds->child = $listper;


        if ($model->load(Yii::$app->request->post())) {
            $request= Yii::$app->request->post(); 

            
            if($request['PassignmentSearch']['child']!=''){

                
                $role = Yii::$app->authManager->getRole($model->parent);                
                
                Yii::$app->authManager->removeChildren($role);    

                foreach($request['PassignmentSearch']['child'] as $key => $value) { 
                
                    $author = $auth->createRole($model->parent);
                    $createPost = $auth->createPermission($value);                    
                    $auth->addChild($author, $createPost);
                    
                }
            }         
            return $this->redirect(['index']);
        } else {

            return $this->render('create', [
                'model' => $model,
                'allParent'=>$allParent,
                'allRule'=>$allRule,
                'authitemchilds'=>$authitemchilds,
            ]);
        }
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($parent)
    {
        $id=$parent;
        $model = new Passignment();
        $auth = Yii::$app->authManager;
        $model = $this->findModel($id);
       
        $searchModel=new PermissionSearch();
        $allParent=  $searchModel->find()->where('type = :type', [':type' => '1'])
->all();
        $allRule=  PermissionSearch::find()->where('type = :type', [':type' => '2'])
->all();

        $listper=array();
        $authitemchilds = new PassignmentSearch();      
        
        $lsit = $model->find()->where(['parent' => $model->parent])->all();
              
        
        foreach ($lsit as $key => $value) {
            $listper[]=$value->child;
        }        
       
        $authitemchilds->child = $listper;


        if ($model->load(Yii::$app->request->post())) {
            $request= Yii::$app->request->post(); 
            
            if($request['PassignmentSearch']['child']!=''){
               
                $role = Yii::$app->authManager->getRole($model->parent);    

                Yii::$app->authManager->removeChildren($role);                    
               
                foreach($request['PassignmentSearch']['child'] as $key => $value) {                
                    $author = $auth->createRole($model->parent);
                    $createPost = $auth->createPermission($value);                    
                    $auth->addChild($author, $createPost);
                }
            }         
            return $this->redirect(['index']);
        } else {

            return $this->render('create', [
                'model' => $model,
                'allParent'=>$allParent,
                'allRule'=>$allRule,
                'authitemchilds'=>$authitemchilds,
            ]);
        }
    }

    /**
     * Deletes an existing Branch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($parent)
    {       
         

        $role = Yii::$app->authManager->getRole($parent);
        if ($role) {
            Yii::$app->authManager->removeChildren($role);
            
        }
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
        if (($model = Passignment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

