<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AuthorsProjectAuthorMatchSearch represents the model behind the search form of `app\models\AuthorsProjectAuthorMatch`.
 */
class AuthorsProjectAuthorMatchSearch extends AuthorsProjectAuthorMatch
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_ppi'], 'integer'],
            [['author_scopus_id', 'erc_field'], 'safe'],
            [['match_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = AuthorsProjectAuthorMatch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'project_ppi' => $this->project_ppi,
            'match_value' => $this->match_value,
        ]);

        $query->andFilterWhere(['ilike', 'author_scopus_id', $this->author_scopus_id])
            ->andFilterWhere(['ilike', 'erc_field', $this->erc_field]);

        return $dataProvider;
    }
}
