<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\PermissionSearch;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $searchModel=new PermissionSearch();
        $allParent=  $searchModel->find()->where('type = :type', [':type' => '1'])
->all();

        if($model->load(Yii::$app->request->post())) {
            $request= Yii::$app->request->post(); 
            $posted_role=$request['PermissionSearch']['name'];
            if ($user = $model->createuser()) { 

                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole($posted_role);
                $auth->assign($authorRole, $user->getId());
                return $this->redirect('index');
                
            }
        }
       
        return $this->render('create', [
            'model' => $model,
            'allParent'=>$allParent,
            'searchModel' =>$searchModel,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $OldRole=Yii::$app->authManager->getRolesByUser($id);
        $OldRole = key($OldRole);
        $searchModel=new PermissionSearch();

       $allParent=  $searchModel->find()->where('type = :type', [':type' => '1'])
->all();

        $searchModel->name=$OldRole;       

      
        if ($model->load(Yii::$app->request->post())) {

            $imageName=$model->username;
            $request= Yii::$app->request->post(); 
            $posted_role=$request['PermissionSearch']['name'];

            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file !=''){
                $model->file->saveAs('uploads/' . $imageName . '.' . $model->file->extension);
                $model->user_image='uploads/' . $imageName . '.' . $model->file->extension;
            }
            $model->updated_at=date('Y-m-d H:i:s');

            if($user=$model->save()){

                $manager = Yii::$app->authManager;
                if($OldRole!=''){
                
                    $item = $manager->getRole($OldRole);
                    $item = $item ? : $manager->getPermission($OldRole);
                    $manager->revoke($item,$id);
                }
                if($posted_role!=''){
                    $authorRole = $manager->getRole($posted_role);
                    $manager->assign($authorRole, $id);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{

                return $this->render('update', [
                    'model' => $model,
                    'allParent'=>$allParent,
                    'searchModel' =>$searchModel,
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'allParent'=>$allParent,
                'searchModel' =>$searchModel,
            ]);
        }
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

        return $this->redirect(['index']);
    }

    public function actionFile($filename)
    {
        
      
       Yii::$app->params['uploadPath'] = realpath(Yii::$app->basePath).'/web';
       $storagePath = Yii::$app->params['uploadPath'] ;

     

       if ( !is_file("$storagePath/$filename")) {
          throw new \yii\web\NotFoundHttpException('The file does not exists.');
       }
       return Yii::$app->response->sendFile("$storagePath/$filename", $filename);
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
