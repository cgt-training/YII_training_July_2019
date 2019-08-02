<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$activeController= Yii::$app->controller->id;
$activeAction = Yii::$app->controller->action->id;
?>

<div class="span12">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data']]); ?>
         <fieldset>


            <?=$form->field($model, 'user_first_name',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ; ?>

            <?=$form->field($model, 'user_last_name',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ; ?>


            <?=$form->field($model, 'username',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ; ?>

            <?=$form->field($model, 'email',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ; ?>   
            <?php
            if($activeAction=='create'){
            ?>
            <?=$form->field($model, 'password_hash',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ; ?>   
            <?php
                }
            ?>

            <?=$form->field($searchModel, 'name',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->dropDownList(ArrayHelper::map($allParent,'name','name'),
            ['prompt'=>'Select parent', 'class'=>'input-xlarge form-control']
            )->label('User Role');?>   

                   
            <!-- <?=$form->field($model, 'file',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->fileInput();?> -->

            <div class="form-group form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? ' btn btn-primary' : 'btn btn-primary']) ?>
            </div>
         </fieldset> 

    <?php ActiveForm::end(); ?>

</div>





