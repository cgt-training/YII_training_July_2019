<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->user_first_name.' '.$model->user_last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    $image='uploads/dummy.png';
    if($model->user_image!=''){
        $image=$model->user_image;
    }
    ?>
    <!-- <? = Html::a(Html::img('@web/'.$image, ['alt'=>'some', 'class'=>'thing','width'=>'150']), ['user/file', 'filename' => $model->user_image],['tabindex'=>'-1']) ?> -->
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            
            'email:email',
            ['attribute'=>'role',
             'value'  => function ($model) {
                 $OldRole=Yii::$app->authManager->getRolesByUser($model->id);
                 $OldRole = key($OldRole);
                return $OldRole;
            },            
            'label' => 'Role'
            ], 
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
