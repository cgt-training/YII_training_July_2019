<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\permission;
?>

<div class="span12">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
         <fieldset>
            
            <?=$form->field($model, 'name',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ;
            ?>    
            <?=$form->field($model, 'description',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control']) ;
            ?>    
            
            <?=$form->field($model, 'type',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->dropDownList([ '1' => 'Role', '2' => 'Auth_rule'],['prompt' => 'Select Type', 'class'=>'input-xlarge form-control']); ?>        

            
            <div class="form-group form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? ' btn btn-primary' : 'btn btn-primary']) ?>
            </div>
         </fieldset> 

    <?php ActiveForm::end(); ?>

</div>



