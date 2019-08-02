<style type="text/css">
    .profile-image img{max-width: 250px; object-fit: cover;border-radius: 50%;height: 200px;width: 200px;border: solid 1px #232323;}
    .profile-image {    margin-bottom: 22px;}
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <h1><?= Html::encode($this->title) ?></h1>
           

    <div class="row">

        <div class="col-md-12">
            <div class="profile-image"> 

                <h4>User Image</h4>
                <!-- $img = Url::to('@web/uploads/PROJECT/').$img_obj['AVATAR'];                 
                $image = '<img src="'.$img.'" width="50" />';   -->
                <img src="<?= Yii::$app->request->baseUrl . '/frontend/web/assets/' . $model->user_image ?>" class=" img-responsive" >  
                <?php //echo Html::img('@web/img/icon.png', ['class' => 'pull-left img-responsive']); ?>
            </div>
        </div>

        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>

                <?= $form->field($model, 'user_first_name') ?>

                <?= $form->field($model, 'user_last_name') ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'user_image')->fileInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div>
        Last Updated : <?=date('d-M-Y h:i A', strtotime($model->updated_at));?>
    </div>

</div>