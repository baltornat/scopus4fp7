<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthorsProjectPpi;

/**
 * AuthorsProjectPpiSearch represents the model behind the search form of `app\models\AuthorsProjectPpi`.
 */
class AuthorsProjectPpiSearch extends AuthorsProjectPpi
{
    public $institutionName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['p_rcn', 'funding_scheme', 'call_year', 'ppi_firstname', 'ppi_lastname', 'organization_url', 'ppi_organization', 'erc_field', 'p_id', 'institutionName'], 'safe'],
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
        $query = AuthorsProjectPpi::find();
        $query->joinWith('institutionName')->groupBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['institutionName'] = [
            'asc' => ['institution.institution_name' => SORT_ASC],
            'desc' => ['institution.institution_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'funding_scheme', $this->funding_scheme])
            ->andFilterWhere(['ilike', 'call_year', $this->call_year])
            ->andFilterWhere(['ilike', 'ppi_firstname', $this->ppi_firstname])
            ->andFilterWhere(['ilike', 'ppi_lastname', $this->ppi_lastname])
            ->andFilterWhere(['ilike', 'organization_url', $this->organization_url])
            ->andFilterWhere(['ilike', 'institution.institution_name', $this->institutionName])
            ->andFilterWhere(['ilike', 'erc_field', $this->erc_field]);
            //->andFilterWhere(['ilike', 'p_id', $this->p_id]);

        return $dataProvider;
    }
}
