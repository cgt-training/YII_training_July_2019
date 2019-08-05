<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Passignment;

/**
 * DepartmentSearch represents the model behind the search form about `backend\models\Department`.
 */
class PassignmentSearch extends Passignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            [['parent'], 'safe'],
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
        $query = Passignment::find()->select('parent')->distinct();       

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
            'parent' => $this->parent,
            'child' => $this->child,
        ]);

        $query->andFilterWhere(['like', 'parent', $this->parent])
        ->andFilterWhere(['child', 'child', $this->child]);


        return $dataProvider;
    }
}
