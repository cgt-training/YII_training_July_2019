<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permissions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row-fluid">                        
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="block-content collapse in">

        <p>
            <?= Html::a('Add Permission', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['attribute'=>'type',
            "content" => function($model, $key, $index, $column) use ($typeArr) {
                    return $typeArr[$model['type']];
            },
             'label' => 'Type'
            ], 
            'description',
             ['class' => 'backend\grid\ActionColumn'],
        ],
        ]); ?>
        <?php Pjax::end(); ?>
        </div>
    </div>
</div>

