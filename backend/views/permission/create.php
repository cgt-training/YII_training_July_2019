<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Branch */

$this->title = 'Create Permission';
$this->params['breadcrumbs'][] = ['label' => 'Permission', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
