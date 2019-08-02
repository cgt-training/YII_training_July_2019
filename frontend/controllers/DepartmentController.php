<?php

namespace frontend\controllers;

use Yii;
use app\models\Department;
use app\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Branch;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Department model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewDepartment')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }

    }

    /**
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if (\Yii::$app->user->can('createDepartment')) {
        $model = new Department();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->department_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }
    }

     public function actionBranch($company)
    {

        $branchlist = Branch::findBySql('select * from branch where company_fk_id ="'.$company.'"')->all();
        //print_r($branchlist);die;
        if(count($branchlist) > 0){
            foreach ($branchlist as $branch) {
                echo '<option value="'.$branch->company_fk_id.'">'.$branch->branch_name.'</option>';
            }
        }else{
            echo '<option>-----</option>';
        }
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateDepartment')) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->department_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }

    }

    /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if (\Yii::$app->user->can('deleteDepartment')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }


    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
