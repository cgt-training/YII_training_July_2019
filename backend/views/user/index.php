<?php

use yii\helpers\Html;
use backend\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row-fluid">                        
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="block-content collapse in">

        <p>
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
             ['attribute'=>'username',
             'value'  => function ($model) {
                 $OldRole=Yii::$app->authManager->getRolesByUser($model->id);
                 $OldRole = key($OldRole);
                return $model->username.' ('.$OldRole.')';
            },            
            'label' => 'User Name / Role'
            ], 
             'email:email',             
             'created_at',        
            ['class' => 'backend\grid\ActionColumn',

            ],
        ],
    ]); ?>
<?php Pjax::end(); 

?>
</div>
 
    </div>
</div>

