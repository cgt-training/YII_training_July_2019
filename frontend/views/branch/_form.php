<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Company;


/* @var $this yii\web\View */
/* @var $model app\models\Branch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'company_fk_id')->textInput() ?> -->

    <div class="form-group field-department-company_fk_id required">
	    <label class="control-label" for="department-company_fk_id">Company</label>
	    <?php 
	    	$company = ArrayHelper::map(Company::find()->all(), 'company_id', 'company_name');
	    ?>

	    <?= Html::activeDropDownList($model, 'company_fk_id',
	      $company,
	      ['class' => 'form-control', 'prompt'=> 'Select Company']
	      ) ?>
	</div>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_created')->textInput() ?>

    <?= $form->field($model, 'branch_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
