<?php

namespace backend\models;

use Yii;
use app\models\Company;
/**
 * This is the model class for table "branch".
 *
 * @property int $branch_id
 * @property int $company_fk_id
 * @property string $branch_name
 * @property string $branch_created
 * @property string $branch_status
 *
 * @property Company $companyFk
 * @property Department[] $departments
 */
class Dashboard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    // public static function tableName()
    // {
    //     return 'branch';
    // }

    public function getLatestCompany(){


        //$query = new \yii\db\Query;
        $query = (new \yii\db\Query());
        $query  ->select([
        'company_id','company_name','(SELECT COUNT(branch_id) from branch WHERE company_fk_id = company.company_id) as total_branch','company_status']
        )  
        ->from('company')
        ->join('LEFT JOIN', 'branch',
            'branch.branch_id =company.company_id')
        ->groupBy('company_id')
        ->LIMIT(5)  ; 


        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;

    }
}
