<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User: ' . $model->user_first_name.' '.$model->user_last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_first_name.' '.$model->user_last_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row-fluid">                        
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><?= Html::encode($this->title) ?></div>
        </div>
        <div class="block-content collapse in">
		    <?= $this->render('_form', [
		        'model' => $model,
		        'allParent' => $allParent,
		        'searchModel' =>$searchModel,
		    ]) ?>
		</div>
	</div>
</div>
