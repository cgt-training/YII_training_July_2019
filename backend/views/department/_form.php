<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Company;

/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'company_fk_id')->textInput() ?> -->

    <div class="form-group field-department-company_fk_id required">
        <label class="control-label" for="department-company_fk_id">Company</label>
        <?php 
            $company = ArrayHelper::map(Company::find()->all(), 'company_id', 'company_name');
        ?>

        <?= Html::activeDropDownList($model, 'company_fk_id',
          $company,
          ['class' => 'form-control', 'prompt'=> 'Select Company' , 'onchange' =>'$.get("'.Url::toRoute('department/branch').'", {company : $(this).val()}).done(function(data){
                $("select#department-branch_fk_id").html(data);
          });
          ']
          ) ?>
    </div>

    <div class="form-group field-department-branch_fk_id required">
        <label class="control-label" for="department-branch_fk_id">Branch</label>
        <select id="department-branch_fk_id" class="form-control" name="Department[branch_fk_id]" aria-invalid="false">
            <option value="">Select Branch</option>
        </select>
    </div>

    <!-- <?= $form->field($model, 'branch_fk_id')->textInput() ?> -->

    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_created')->textInput() ?>

    <?= $form->field($model, 'department_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
