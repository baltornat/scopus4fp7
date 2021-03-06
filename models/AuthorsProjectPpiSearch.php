<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AuthorsProjectPpiSearch represents the model behind the search form of `app\models\AuthorsProjectPpi`.
 */
class AuthorsProjectPpiSearch extends AuthorsProjectPpi
{
    public $ppiOrganization;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['p_rcn', 'funding_scheme', 'call_year', 'ppi_firstname', 'ppi_lastname', 'organization_url', 'ppi_organization', 'erc_field', 'p_id', 'ppiOrganization'], 'safe'],
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
        $query = AuthorsProjectPpi::find();
        $query->joinWith('ppiOrganization');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['ppiOrganization'] = [
            'asc' => ['cordis.cordis_project.ppi_organization' => SORT_ASC],
            'desc' => ['cordis.cordis_project.ppi_organization' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'project_ppi.id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'project_ppi.funding_scheme', $this->funding_scheme])
            ->andFilterWhere(['ilike', 'project_ppi.call_year', $this->call_year])
            ->andFilterWhere(['ilike', 'project_ppi.ppi_firstname', $this->ppi_firstname])
            ->andFilterWhere(['ilike', 'project_ppi.ppi_lastname', $this->ppi_lastname])
            ->andFilterWhere(['ilike', 'project_ppi.organization_url', $this->organization_url])
            ->andFilterWhere(['ilike', 'cordis.cordis_project.ppi_organization', $this->ppiOrganization])
            ->andFilterWhere(['ilike', 'project_ppi.erc_field', $this->erc_field]);

        return $dataProvider;
    }
}
