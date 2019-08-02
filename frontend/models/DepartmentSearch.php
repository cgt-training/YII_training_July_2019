<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Department;

/**
 * DepartmentSearch represents the model behind the search form of `app\models\Department`.
 */
class DepartmentSearch extends Department
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id'], 'integer'],
            [['department_name', 'department_created', 'department_status','company_fk_id','branch_fk_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params)
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
            //'company_fk_id' => $this->company_fk_id,
            //'branch_fk_id' => $this->branch_fk_id,
            'department_created' => $this->department_created,
        ]);

        $query->andFilterWhere(['like', 'department_name', $this->department_name])
            ->andFilterWhere(['like', 'department_status', $this->department_status])
            ->andFilterWhere(['like', 'company.company_name', $this->company_fk_id])
            ->andFilterWhere(['like', 'branch.branch_name', $this->branch_fk_id]);

        return $dataProvider;
    }
}
