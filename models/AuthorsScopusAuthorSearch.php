<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthorsScopusAuthor;

/**
 * AuthorsScopusAuthorSearch represents the model behind the search form of `app\models\AuthorsScopusAuthor`.
 */
class AuthorsScopusAuthorSearch extends AuthorsScopusAuthor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_ppi', 'num_documents'], 'integer'],
            [['author_scopus_id', 'firstname', 'lastname', 'affil_id', 'affil_name', 'affil_city', 'affil_country', 'author_modality'], 'safe'],
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
        $query = AuthorsScopusAuthor::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_ppi' => $this->project_ppi,
            'num_documents' => $this->num_documents,
        ]);

        $query->andFilterWhere(['ilike', 'author_scopus_id', $this->author_scopus_id])
            ->andFilterWhere(['ilike', 'firstname', $this->firstname])
            ->andFilterWhere(['ilike', 'lastname', $this->lastname])
            ->andFilterWhere(['ilike', 'affil_id', $this->affil_id])
            ->andFilterWhere(['ilike', 'affil_name', $this->affil_name])
            ->andFilterWhere(['ilike', 'affil_city', $this->affil_city])
            ->andFilterWhere(['ilike', 'affil_country', $this->affil_country])
            ->andFilterWhere(['ilike', 'author_modality', $this->author_modality]);

        return $dataProvider;
    }
}
