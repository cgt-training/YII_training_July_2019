<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\passignment;

$activeController= Yii::$app->controller->id;
$activeAction = Yii::$app->controller->action->id;
?>

<div class="span12 permissionForm">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
         <fieldset>          
          
          <?php
            if($activeAction=='create'){
          ?>  
        <?=$form->field($model, 'parent',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->dropDownList(ArrayHelper::map($allParent,'name','name'),
            ['prompt'=>'Select parent', 'class'=>'input-xlarge form-control']
        );?>   
        <?php
        }else{?>
        <<?=$form->field($model, 'parent',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->textInput(['maxlength' => true,'class'=>'input-xlarge form-control','readonly' => !$model->isNewRecord  ]) ;
            ?>

        <?php
        }
        ?>
       <?php
       $rule=ArrayHelper::map($allRule,'name','name'); 

       ?>
           
        <?=$form->field($authitemchilds, 'child',['options'=>['tag' => 'div','class' => 'form-group control-group'],'template' => '{label}<div class="controls">{input}{error}</div>'])->checkboxList
                ($rule,['class' => 'checkbox taxonomy-menu-item','separator' => '<br>'])?> 
      

        <div class="form-group form-actions">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? ' btn btn-primary' : 'btn btn-primary']) ?>
            </div>
        </fieldset> 
    <?php ActiveForm::end(); ?>
</div>
 