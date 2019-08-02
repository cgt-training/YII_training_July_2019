<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = Yii::t('app', 'Update Company: {name}', [
    'name' => $model->company_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_id, 'url' => ['view', 'id' => $model->company_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
