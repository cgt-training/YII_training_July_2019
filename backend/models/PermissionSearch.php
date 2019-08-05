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
    // public function scenarios()
    // {
    //     // bypass scenarios() implementation in the parent class
    //     return Model::scenarios();
    // }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

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
            'name' => $this->name,
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
