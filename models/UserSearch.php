<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    public $authAssignment;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'email', 'password', 'name', 'surname', 'authKey', 'accessToken', 'authAssignment'], 'safe'],
            [['isDisabled'], 'boolean'],
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
        $query = User::find();
        $query->joinWith('authAssignment');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['authAssignment'] = [
            'asc' => ['auth_assignment.item_name' => SORT_ASC],
            'desc' => ['auth_assignment.item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'isDisabled' => $this->isDisabled,
            'auth_assignment.item_name' => $this->authAssignment,
        ]);

        $query->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'surname', $this->surname]);

        return $dataProvider;
    }
}
