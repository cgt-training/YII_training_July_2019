<?php

namespace frontend\controllers;

use Yii;
use app\models\Company;
use app\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         if (\Yii::$app->user->can('viewCompany')) {
        return $this->render('view', [
            'model' => $this->findModel($id),
            
        ]);

        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }

    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

         if (\Yii::$app->user->can('createCompany')) {

            $model = new Company();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->company_id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);

        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('updateCompany')) {
                
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->company_id]);
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
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
         if (\Yii::$app->user->can('deleteCompany')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', "You have no authorized to proceed the above request..");
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
