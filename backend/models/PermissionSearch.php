<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Permission;

/**
 * DepartmentSearch represents the model behind the search form about `backend\models\Department`.
 */
class PermissionSearch extends Permission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            [['name', 'type', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search1($params)
    {
        $query = Department::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
             
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinwith('companyFk');
        $query->joinwith('branchFk');

        // grid filtering conditions
        $query->andFilterWhere([
            'department_id' => $this->department_id,          
            'department_created' => $this->department_created,
        ]);

        $query->andFilterWhere(['like', 'department_name', $this->department_name])
        ->andFilterWhere(['like', 'department_status', $this->department_status])
        ->andFilterWhere(['like', 'company.company_name', $this->company_fk_id])
        ->andFilterWhere(['like', 'branch.branch_name', $this->branch_fk_id]);

        return $dataProvider;
    }

    public function search($params)
    {
        $query = Permission::find();       

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           'pagination' => [ 'pageSize' => isset($params['noItemSelected'])?$params['noItemSelected']:10 ],

        ]);     

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }    

         $query->andFilterWhere([
            //'name' => $this->name,
            //'description' => $this->description,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type]);

        // echo "<pre>";
        //  print_r($query->createCommand()->getRawSql());die;
        return $dataProvider;
    }
}
