<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Branch */

$this->title = 'Update Permission: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
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
		    ]) ?>
		</div>
	</div>
</div>
