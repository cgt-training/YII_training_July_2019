<?php

namespace backend\models;


use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;


/**
 * This is the model class for table "branch".
 *
 * @property integer $branch_id
 * @property integer $company_fk_id
 * @property string $branch_name
 * @property string $branch_created
 * @property string $branch_status
 *
 * @property Company $companyFk
 * @property Department[] $departments
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }  
     
}
