<?php

namespace backend\models;


use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "auth_item".
 * 
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    public function rules()
    {
        return [
            [['name', 'type', 'description'], 'required'],
            [['name'], 'unique'],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule',
            
        ];
    }

    public function search($params)
    {
        $query = $this->find();       

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'pagination' => [ 'pageSize' => 10 ],
        ]);     

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }    

         $query->andFilterWhere([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'description', $this->description]);


        return $dataProvider;
    }

   
}
