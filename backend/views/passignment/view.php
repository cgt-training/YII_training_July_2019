<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;


/* @var $this yii\web\View */
/* @var $model backend\models\Branch */

$this->title = $model->parent;
$this->params['breadcrumbs'][] = ['label' => 'Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>        
        <?= Html::a('Delete', ['delete', 'parent' => $model->parent], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row1">
    <table class=" table table-bordered">
        <tr>
            <th width="40%">Parent</th>
            <th>Child</th>
        </tr>
        <?php
        foreach ($child->child as $key => $value) {
        if($key==0){
            $parent=$value['parent'];
        }else{
            $parent='';

        }
       ?>

        <tr>
            <td><?=$parent?></td>
            <td><?=$value['child']?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
</div>
