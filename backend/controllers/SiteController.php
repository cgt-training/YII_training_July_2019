<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\Dashboard;
use yii\rbac\Rule;
use common\models\AuthorRule;
use yii\rbac\ManagerInterface;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $auth = Yii::$app->authManager;
        //$adminRole = $auth->getRole('admin');
        //$auth->assign($adminRole, 18);



        // // add "createPost" permission
        // $createPost = $auth->createPermission('createPost');
        // $createPost->description = 'Create a post';
        // $auth->add($createPost);

        // // add "updatePost" permission
        // $updatePost = $auth->createPermission('updatePost');
        // $updatePost->description = 'Update post';
        // $auth->add($updatePost);

        // // add "author" role and give this role the "createPost" permission
        // $author = $auth->createRole('author');
        // $auth->add($author);
        // echo '-----------createpost----------';
        // print_r($createPost);
        // $auth->addChild($author, $createPost);

        // // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "author" role
        // $admin1 = $auth->createRole('admin1');
        // $auth->add($admin1);
        // $auth->addChild($admin1, $updatePost);
        // echo '--------manageer----------';
        // print_r($admin1);
        // $auth->addChild($admin1, $author);


        // die;


       //$rule = new AuthorRule;

        //$auth->add($rule);

       // print_r($auth->getPermissions()['updateCompany']);
       // print_r($auth->getRoles()['manager']);die;
        //$auth->getRoles()['manager']


        // add the "updateOwnPost" permission and associate the rule with it.
        // $updateOwnCompany = $auth->createPermission('updateOwnCompany');
        // //print_r($updateOwnCompany);die;
        // $updateOwnCompany->description = 'Update own company';
        // $updateOwnCompany->ruleName = $rule->name;
        // $auth->add($updateOwnCompany);

        // // "updateOwnPost" will be used from "updatePost"
        // $auth->addChild($updateOwnCompany, $auth->getPermissions()['updateCompany']);

        // // allow "author" to update their own posts
        // $auth->addChild($auth->getRoles()['manager'], $updateOwnCompany);


        // $auth = Yii::$app->authManager;
        // $auth->removeAll();

        // /*******************************Company***************************************/

        // // add "createCompany" permission
        // $createCompany = $auth->createPermission('createCompany');
        // $createCompany->description = 'Create a company';
        // $auth->add($createCompany);

        // // add "viewCompany" permission
        // $viewCompany = $auth->createPermission('viewCompany');
        // $viewCompany->description = 'View a company';
        // $auth->add($viewCompany);

        // // add "updateCompany" permission
        // $updateCompany = $auth->createPermission('updateCompany');
        // $updateCompany->description = 'Update company';
        // $auth->add($updateCompany);

        // //delete company
        // $deleteCompany = $auth->createPermission('deleteCompany');
        // $deleteCompany->description = 'Delete company';
        // $auth->add($deleteCompany);

        // /*******************************Branch***************************************/

        // // add "createBranch" permission
        // $createBranch = $auth->createPermission('createBranch');
        // $createBranch->description = 'Create a branch';
        // $auth->add($createBranch);

        // // add "viewBranch" permission
        // $viewBranch = $auth->createPermission('viewBranch');
        // $viewBranch->description = 'View branch';
        // $auth->add($viewBranch);

        // // add "updateBranch" permission
        // $updateBranch = $auth->createPermission('updateBranch');
        // $updateBranch->description = 'Update branch';
        // $auth->add($updateBranch);

        // //delete Branch
        // $deleteBranch = $auth->createPermission('deleteBranch');
        // $deleteBranch->description = 'Delete branch';
        // $auth->add($deleteBranch);

        // /*******************************Department***************************************/

        // // add "createDepartment" permission
        // $createDepartment = $auth->createPermission('createDepartment');
        // $createDepartment->description = 'Create a department';
        // $auth->add($createDepartment);

        // // add "viewDepartment" permission
        // $viewDepartment = $auth->createPermission('viewDepartment');
        // $viewDepartment->description = 'View department';
        // $auth->add($viewDepartment);

        // // add "updateDepartment" permission
        // $updateDepartment = $auth->createPermission('updateDepartment');
        // $updateDepartment->description = 'Update department';
        // $auth->add($updateDepartment);

        // //delete Department
        // $deleteDepartment = $auth->createPermission('deleteDepartment');
        // $deleteDepartment->description = 'Delete department';
        // $auth->add($deleteDepartment);


        // /*******************************Employess Roles and permission***************************************/

        // // add "employee" role and give this role the "viewCompany"
        // $employee = $auth->createRole('employee');
        // $auth->add($employee);
        // $auth->addChild($employee, $viewCompany);
        // $auth->addChild($employee, $viewBranch);
        // $auth->addChild($employee, $viewDepartment);


        // /*******************************Manager Role and permission***************************************/

        // // add "manager" role and give this role the "UpdateCompany" "viewCompany"
        // $manager = $auth->createRole('manager');
        // $auth->add($manager);
        // $auth->addChild($manager, $updateCompany);
        // $auth->addChild($manager, $updateBranch);
        // $auth->addChild($manager, $updateDepartment);

        // $auth->addChild($manager, $employee);



        // /*******************************Manager Admin and permission***************************************/

        // // add "admin" role and give this role the "createCompany" "UpdateCompany" "viewCompany" "deleteCompany"
        // $admin = $auth->createRole('admin');
        // $auth->add($admin);
        // $auth->addChild($admin, $createCompany);
        // $auth->addChild($admin, $createBranch);
        // $auth->addChild($admin, $createDepartment);

        // $auth->addChild($admin, $deleteCompany);
        // $auth->addChild($admin, $deleteBranch);
        // $auth->addChild($admin, $deleteDepartment);

        // $auth->addChild($admin, $manager);
        // $auth->addChild($admin, $employee);




        // // add "author" role and give this role the "createPost" permission
        // $author = $auth->createRole('author');
        // $auth->add($author);
        // $auth->addChild($author, $createPost);

        // // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "author" role
        // $admin = $auth->createRole('admin');
        // $auth->add($admin);
        // $auth->addChild($admin, $updatePost);
        // $auth->addChild($admin, $author);

        // // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // // usually implemented in your User model.
        // $auth->assign($author, 2);
        // $auth->assign($admin, 18);


        // $auth = \Yii::$app->authManager;
        // $adminRole = $auth->getRole('admin');
        // $auth->assign($adminRole, 18);

        // $auth = Yii::$app->authManager;

        // // add the rule
        // $rule = new \app\rbac\AuthorRule;

        // print_r(get_class_methods(Yii::$app->user->can('')));die;
        
        // if (Yii::$app->user->can('deleteCompany')) {
        //     print_r('access granted');
        // }else{
        //     print_r('access dined');
        // }
        // die;

        $dashboard = new dashboard();
        //print_r($dashboard->getLatestCompany());die;
        return $this->render('index',[
                'dashboard' => $dashboard
            ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout='login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
